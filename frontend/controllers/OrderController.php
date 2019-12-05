<?php
/**
 * Created by PhpStorm.
 * User: td779
 * Date: 05.12.2019
 * Time: 22:41
 */

namespace frontend\controllers;


use yii\web\Controller;

class OrderController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index', [

        ]);
    }

}