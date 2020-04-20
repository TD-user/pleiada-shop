<?php

namespace frontend\controllers;

use common\models\Cart;
use common\models\Favourite;
use common\models\NpCities;
use common\models\Oneclickorder;
use common\models\Order;
use common\models\Product;
use common\models\ProductTemp;
use common\models\User;
use frontend\models\UpdateForm;
use Yii;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\helpers\Url;
use LisDev\Delivery\NovaPoshtaApi2;
use yii\web\NotFoundHttpException;

class UserController extends Controller
{
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('warning', 'Для подальшої роботи з сайтом вам необхідно зареєструватися або увійти у свій аккаунт');
            return $this->goHome();
        }

        $model = new UpdateForm();

        if ($model->load(Yii::$app->request->post())&& $model->userUpdate(Yii::$app->user->id)) {
            Yii::$app->session->setFlash('success', 'Успішно оновлені дані');
            return $this->goHome();
        }

        $user = User::findOne(Yii::$app->user->id);
        $model->id = $user->id;
        $model->email = $user->email;
        $model->phone = $user->phone;
        $model->surname = $user->surname;
        $model->name = $user->name;
        $model->fathername = $user->fathername;
        $model->birthday = $user->birthday;
        $model->gender = $user->gender;
        $model->city = $user->city;
        $model->username = $user->username;

        $orders = Yii::$app->user->identity->getOrders()->orderBy(['created_at' => SORT_DESC]);

        $pagination = new Pagination([
            'defaultPageSize' => 20,
            'totalCount' => $orders->count(),
        ]);

        $orders = $orders->offset($pagination->offset)->limit($pagination->limit)->all();

        return $this->render('index', [
            'model' => $model,
            'orders' => $orders,
            'pagination' => $pagination,
        ]);
    }

    public function actionFavourite()
    {
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('warning', 'Для подальшої роботи з сайтом вам необхідно зареєструватися або увійти у свій аккаунт');
            return $this->goHome();
        }
        else {
            $favourites = Yii::$app->user->identity->getProductsFavourite()->orderBy(['remains' => SORT_DESC]);

            $pagination = new Pagination([
                'defaultPageSize' => 20,
                'totalCount' => $favourites->count(),
            ]);

            $favourites = $favourites->offset($pagination->offset)->limit($pagination->limit)->all();

            return $this->render('favourite', [
                'products' => $favourites,
                'pagination' => $pagination,
            ]);
        }
    }

    public function actionAllWatchedProducts()
    {
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('warning', 'Для подальшої роботи з сайтом вам необхідно зареєструватися або увійти у свій аккаунт');
            return $this->goHome();
        }

        $watchedProducts = null;
        $pagination = null;

        $cookies = Yii::$app->request->cookies;
        if ($cookies->has('watchedProducts')) {
            $watchedProducts = $cookies->getValue('watchedProducts');
            $watchedProducts = explode(',', $watchedProducts);
            $watchedProducts = array_unique($watchedProducts);
            $watchedProducts = array_slice($watchedProducts, 0, 120);
            $cookies = Yii::$app->response->cookies;
            $cookies->add(new \yii\web\Cookie([
                'name' => 'watchedProducts',
                'value' => implode(',', $watchedProducts),
                'expire' => time() + 86400 * 365,
            ]));
            $watchedProducts = Product::find()->where(['in', 'id', $watchedProducts]);

            $pagination = new Pagination([
                'defaultPageSize' => 20,
                'totalCount' => $watchedProducts->count(),
            ]);

            $watchedProducts = $watchedProducts->offset($pagination->offset)->limit($pagination->limit)->all();
        }

        return $this->render('watched', [
            'products' => $watchedProducts,
            'pagination' => $pagination,
        ]);
    }

    public function actionCart()
    {
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('warning', 'Для подальшої роботи з сайтом вам необхідно зареєструватися або увійти у свій аккаунт');
            return $this->goHome();
        }
        else {
            $carts = Yii::$app->user->identity->getProductsCart()->all();
            $modelOneClickOrder = new Oneclickorder();
            $modelOneClickOrder->phone = Yii::$app->user->identity->phone;
            $cities = NpCities::find()->all();
            $cities = ArrayHelper::map($cities, 'Ref', 'Description');
            $order = new Order();
            $order->email = Yii::$app->user->identity->email;
            $order->name = Yii::$app->user->identity->name;
            $order->surname = Yii::$app->user->identity->surname;
            $order->phone = Yii::$app->user->identity->phone;

            return $this->render('cart', [
                'products' => $carts,
                'modelOneClickOrder' => $modelOneClickOrder,
                'cities' => $cities,
                'order' => $order,
            ]);
        }
    }

    public function actionPayment($id)
    {
        $order = $this->findOrder($id);
        $order->cost = $order->total;

        return $this->render('payment', [
            'model' => $order,
        ]);
    }

    public function actionOrder()
    {
        if(Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('warning', 'Для подальшої роботи з сайтом вам необхідно зареєструватися або увійти у свій аккаунт');
            return $this->goHome();
        }

        $order = new Order();
        if ($order->load(Yii::$app->request->post()) && $order->save() ) {

            $validateOrder = [];
            $newTotal = 0;
            $flag = true;
            foreach (json_decode($order->products_json) as $prodOrder) {
                if (($product = Product::findOne($prodOrder->product_id)) !== null) {
                    $productTemp = new ProductTemp();
                    $productTemp->product = $product;

                    $productTemp->product_id = $product->id;
                    $productTemp->name = $prodOrder->name;
                    $productTemp->price = $prodOrder->price;

                    if($prodOrder->count > $product->remains)
                        $productTemp->count = $product->remains;
                    else if ($prodOrder->count < 1)
                        $productTemp->count = 1;
                    else
                        $productTemp->count = $prodOrder->count;

                    $productTemp->summa = $prodOrder->summa;

                    if($productTemp->validateUserData())
                        $validateOrder[] = $prodOrder;
                    else {
                        $flag = false;
                        $productTemp->ifNotValid();
                        $prodOrder->product_id = $productTemp->product_id;
                        $prodOrder->name = $productTemp->name;
                        $prodOrder->price = $productTemp->price;
                        $prodOrder->count = $productTemp->count;
                        $prodOrder->summa = $productTemp->price * $productTemp->count;
                        $validateOrder[] = $prodOrder;
                    }
                    $newTotal += $prodOrder->summa;
                }
            }
            $order->products_json = json_encode($validateOrder);

            $this->updateUserCarts($order->products_json);

            if($order->total != $newTotal) {
                $order->total = $newTotal;
                $flag = false;
            }
            $order->user_id = Yii::$app->user->identity->id;
            $order->status = 'Нове';
            if($order->is_payment != 1) {
                $order->is_payment = 0;
            }
            $order->save();

//            if($flag and $order->is_payment == 1) {
//                return $this->redirect(Url::to(['user/payment', 'id' => $order->id]));
//            }

            if($flag) {
                Yii::$app->session->setFlash('success', 'Дякуємо за замовлення. Наш менеджер зателефонує вам найблищим часом для уточнення деталей');
                Yii::$app->user->identity->clearCarts();
            }
            else
                Yii::$app->session->setFlash('warning', 'Дякуємо за замовлення. Нажаль під час обробки замовлення, виникли певні проблеми. Наш менеджер зателефонує вам найблищим часом для уточнення деталей');

            return $this->goHome();
        }
        else {
            return $this->redirect(Url::to(['user/cart']));
        }
    }

    public function actionOneClickOrder()
    {
        if(Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('warning', 'Для подальшої роботи з сайтом вам необхідно зареєструватися або увійти у свій аккаунт');
            return $this->goHome();
        }

        $modelOneClickOrder = new Oneclickorder();

        if ($modelOneClickOrder->load(Yii::$app->request->post()) && $modelOneClickOrder->save() ) {

            $validateOrder = [];
            $newTotal = 0;
            $flag = true;
            foreach (json_decode($modelOneClickOrder->products_json) as $prodOrder) {
                if (($product = Product::findOne($prodOrder->product_id)) !== null) {
                    $productTemp = new ProductTemp();
                    $productTemp->product = $product;

                    $productTemp->product_id = $product->id;
                    $productTemp->name = $prodOrder->name;
                    $productTemp->price = $prodOrder->price;

                    if($prodOrder->count > $product->remains)
                        $productTemp->count = $product->remains;
                    else if ($prodOrder->count < 1)
                        $productTemp->count = 1;
                    else
                        $productTemp->count = $prodOrder->count;

                    $productTemp->summa = $prodOrder->summa;

                    if($productTemp->validateUserData())
                        $validateOrder[] = $prodOrder;
                    else {
                        $flag = false;
                        $productTemp->ifNotValid();
                        $prodOrder->product_id = $productTemp->product_id;
                        $prodOrder->name = $productTemp->name;
                        $prodOrder->price = $productTemp->price;
                        $prodOrder->count = $productTemp->count;
                        $prodOrder->summa = $productTemp->price * $productTemp->count;
                        $validateOrder[] = $prodOrder;
                    }
                    $newTotal += $prodOrder->summa;
                }
            }
            $modelOneClickOrder->products_json = json_encode($validateOrder);

            $this->updateUserCarts($modelOneClickOrder->products_json);

            if($modelOneClickOrder->total != $newTotal) {
                $modelOneClickOrder->total = $newTotal;
                $flag = false;
            }
            $modelOneClickOrder->save();

            if($flag)
                Yii::$app->session->setFlash('success', 'Дякуємо за замовлення. Наш менеджер зателефонує вам найблищим часом для уточнення деталей');
            else
                Yii::$app->session->setFlash('warning', 'Дякуємо за замовлення. Нажаль під час обробки замовлення, виникли певні проблеми. Наш менеджер зателефонує вам найблищим часом для уточнення деталей');

            return $this->goHome();
        }
        else {
            return $this->redirect(Url::to(['user/cart']));
        }
    }



    public function actionAddToFavourite($productId)
    {
        if(!Yii::$app->request->isAjax)
            return $this->goHome();

        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('warning', 'Щоб мати можливість зберігати товари в "Улюблених" Вам необхідно зареєструватися або увійти у свій аккаунт');
            return $this->goHome();
        }
        else {
            $favourite = new Favourite();
            $favourite->user_id = Yii::$app->user->identity->id;
            $favourite->product_id = $productId;
            $favourite->save();
            $count = Yii::$app->user->identity->getFavourites()->count();
            return $count;
        }
    }

    public function actionDelFromFavourite($productId)
    {
        if(!Yii::$app->request->isAjax)
            return $this->goHome();

        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('warning', 'Щоб мати можливість зберігати товари в "Улюблених" Вам необхідно зареєструватися або увійти у свій аккаунт');
            return $this->goHome();
        }
        else {
            $favourite = Favourite::find()->where(['product_id' => $productId])->one();
            $favourite->delete();
            $count = Yii::$app->user->identity->getFavourites()->count();
            return $count;
        }
    }

    public function actionAddToCart($productId)
    {
        if(!Yii::$app->request->isAjax)
            return $this->goHome();

        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('warning', 'Щоб мати можливість добавляти товари в "Кошик" та здійснювати покупки Вам необхідно зареєструватися або увійти у свій аккаунт');
            return $this->goHome();
        }
        else {
            $cart = new Cart();
            $cart->user_id = Yii::$app->user->identity->id;
            $cart->product_id = $productId;
            $cart->count = 1;
            $cart->save();

            $count = Yii::$app->user->identity->getCarts()->count();
            return $count;
        }
    }

    public function actionDelFromCart($productId, $json)
    {
        if(!Yii::$app->request->isAjax)
            return $this->goHome();

        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('warning', 'Щоб мати можливість добавляти товари в "Кошик" та здійснювати покупки Вам необхідно зареєструватися або увійти у свій аккаунт');
            return $this->goHome();
        }
        else {
            $this->updateUserCarts($json);

            $cart = Cart::find()->where(['product_id' => $productId, 'user_id' => Yii::$app->user->identity->id])->one();
            $cart->delete();

            $array = [];

            $carts = Yii::$app->user->identity->getProductsCart()->all();
            $array['partial'] = $this->renderAjax('cartPartial', [
                'products' => $carts,
            ]);
            $array['count'] = Yii::$app->user->identity->getCarts()->count();

            return json_encode($array);
        }
    }

    protected function updateUserCarts($json)
    {
        $data = json_decode($json);
        foreach ($data as $cart) {
            $c = Cart::find()->where(['product_id' => $cart->product_id, 'user_id' => Yii::$app->user->identity->id])->one();
            $c->count = $cart->count;
            $c->save();
        }
    }

    public function actionGetWarehouses($ref)
    {
        $np = new NovaPoshtaApi2(
            '75af0d52acbabcfeaa41bda3c7faf524',
            'ua', // Язык возвращаемых данных: ru (default) | ua | en
            FALSE, // При ошибке в запросе выбрасывать Exception: FALSE (default) | TRUE
            'curl' // Используемый механизм запроса: curl (defalut) | file_get_content
        );

        $warehouses = $np->getWarehouses($ref);

        return json_encode($warehouses);
    }

    protected function findOrder($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
