<?php

namespace frontend\controllers;

use common\models\Product;
use Yii;
use common\models\Categories;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\data\SqlDataProvider;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

/**
 * CategoriesController implements the CRUD actions for Categories model.
 */
class CategoriesController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Categories models.
     * @return mixed
     */
    public function actionIndex()
    {
        $categories = Categories::getTreeMenuArray();

        return $this->render('index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Displays a single Categories model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($alias)
    {
        $model = Categories::find()->where(['alias' => $alias])->one();

        if (empty($model)) {
            return $this->goHome();
        }

        $products = null;

        $sort = Yii::$app->request->get('sort');
        if(empty($sort)) $sort = 1;

        $products = $model->getAllProducts($sort);

        //$products = $model->getSingleProducts($sort);

        $dataProvider = new ArrayDataProvider([
            'allModels' => $products,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        $pagination = new Pagination([
            'defaultPageSize' => 20,
            'totalCount' => $dataProvider->getTotalCount(),
        ]);

        $products = $dataProvider->getModels();

        return $this->render('view', [
            'model' => $model,
            'products' => $products,
            'pagination' => $pagination,
            'sort' => $sort
        ]);

    }

    /**
     * Finds the Categories model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Categories the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Categories::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
