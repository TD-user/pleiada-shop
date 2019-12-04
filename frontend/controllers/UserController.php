<?php

namespace frontend\controllers;

use Yii;
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
        return $this->render('favourite');
    }



}
