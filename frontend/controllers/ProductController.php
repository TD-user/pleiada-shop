<?php

namespace frontend\controllers;

use common\models\Product;
use common\models\Reviews;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class ProductController extends Controller
{
    public function actionIndex()
    {
        //return $this->render('index');
        return $this->goHome();
    }

    public function actionView($alias, $id)
    {
        $model = $this->findModel($id);
        $modelReview = new Reviews();

        $cookies = Yii::$app->request->cookies;
        if ($cookies->has('watchedProducts')) {
            $list = $model->id.','.$cookies['watchedProducts']->value;
            $cookies = Yii::$app->response->cookies;
            $cookies->add(new \yii\web\Cookie([
                'name' => 'watchedProducts',
                'value' => $list,
            ]));
        } else {
            $cookies = Yii::$app->response->cookies;
            $cookies->add(new \yii\web\Cookie([
                'name' => 'watchedProducts',
                'value' => $model->id,
            ]));
        }

        if ($modelReview->load(Yii::$app->request->post()) && $modelReview->save()) {
            Yii::$app->session->setFlash('success', 'Дякуємо за відгук. Усі відвідувачі незабаром зможуть побачити його');
            return $this->redirect(['view', 'id' => $id]);
        }

        return $this->render('view', [
            'model' => $model,
            'modelReview' => $modelReview,
        ]);
    }

    public function actionSearch()
    {
        $products = null;
        $pagination = null;
        $count = 0;

        $search = Yii::$app->request->get('q');
        $arr = explode(' ', $search);
        $products = Product::find()->where(['like', 'name', $arr])->orderBy(['remains' => SORT_DESC]);

        if(isset($products)) {
            $count = $products->count();
            $pagination = new Pagination([
                'defaultPageSize' => 20,
                'totalCount' => $count,
            ]);
            $products = $products->offset($pagination->offset)->limit($pagination->limit)->all();
        }

        return $this->render('search', [
            'search' => $search,
            'count' => $count,
            'products' => $products,
            'pagination' => $pagination,
        ]);

    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}