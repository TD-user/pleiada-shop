<?php

namespace frontend\controllers;

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
        return $this->render('cart');
    }

    public function actionFavourite()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        else {
            $favourites = Yii::$app->user->identity->getProductsFavourite();

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





            return $this->goHome();
        }
        else {
            $favourite = Favourite::find()->where(['product_id' => $productId])->one();
            $favourite->delete();
            $count = Yii::$app->user->identity->getFavourites()->count();
            return $count;
        }
    }

}
