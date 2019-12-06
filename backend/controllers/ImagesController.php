<?php
/**
 * Created by PhpStorm.
 * User: td779
 * Date: 07.12.2019
 * Time: 1:00
 */

namespace backend\controllers;

use yii\web\Controller;
use common\models\Images;
use yii\web\NotFoundHttpException;

class ImagesController extends Controller
{

    public function actionDelete($id)
    {
        return $this->findModel($id)->delete();
    }

    protected function findModel($id)
    {
        if (($model = Images::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}