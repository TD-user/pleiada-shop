<?php

namespace frontend\controllers;

use common\models\Cart;
use common\models\Favourite;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;

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

            return $this->render('cart', [
                'products' => $carts,
            ]);
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
            $c = Cart::find()->where(['product_id' => $cart->product, 'user_id' => Yii::$app->user->identity->id])->one();
            $c->count = $cart->count;
            $c->save();
        }
    }




}
