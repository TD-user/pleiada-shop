<?php

namespace frontend\controllers;

use common\models\Cart;
use common\models\Favourite;
use common\models\NpCities;
use common\models\Oneclickorder;
use common\models\Product;
use common\models\ProductTemp;
use Yii;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\helpers\Url;

class UserController extends Controller
{
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        return $this->render('index');
    }

    public function actionCart()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        else {
            $carts = Yii::$app->user->identity->getProductsCart()->all();
            $modelOneClickOrder = new Oneclickorder();
            $cities = NpCities::find()->all();
            $cities = ArrayHelper::map($cities, 'Ref', 'Description');

            return $this->render('cart', [
                'products' => $carts,
                'modelOneClickOrder' => $modelOneClickOrder,
                'cities' => $cities,
            ]);
        }
    }

    public function actionOneClickOrder()
    {
        $modelOneClickOrder = new Oneclickorder();
        if ($modelOneClickOrder->load(Yii::$app->request->post()) && $modelOneClickOrder->save() ) {

            $this->updateUserCarts($modelOneClickOrder->products_json);

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
                        $prodOrder->summa = $productTemp->summa;
                        $validateOrder[] = $prodOrder;
                    }
                    $newTotal += $prodOrder->summa;
                }
            }
            $modelOneClickOrder->products_json = json_encode($validateOrder);
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

    public function actionFavourite()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        else {
            $favourites = Yii::$app->user->identity->getProductsFavourite()->orderBy(['remains' => SORT_DESC]);;

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

    public function actionAddToFavourite($productId)
    {
        if (Yii::$app->user->isGuest) {
            //todo for guest, use cookie

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
        if (Yii::$app->user->isGuest) {
            //todo for guest, use cookie

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
        if (Yii::$app->user->isGuest) {
            //todo for guest, use cookie

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
        if (Yii::$app->user->isGuest) {
            //todo for guest, use cookie

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

}
