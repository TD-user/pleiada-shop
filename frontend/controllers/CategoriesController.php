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
    public function actionView($alias, $sort = 1)
    {
        $model = Categories::find()->where(['alias' => $alias])->one();

        if (empty($model)) {
            return $this->goHome();
        }

        $sort = Yii::$app->request->get('sort');
        if($sort != 1) var_dump($sort);

        //$products = $model->getProducts()->where(['>','remains',0])->union($model->getProducts()->where(['remains' => 0]));

        $products = null;

//        if($model->id_parent != 0) {
//          $products = $model->getProducts()->orderBy(['remains' => SORT_DESC]);
//        //todo:
//        } else {
//            $catArr = Categories::find()->select('id')->where(['id_parent' => $model->id]);
//            $products = Product::find()
//                ->where(['category_id' => $catArr])
//                ->orderBy(['remains' => SORT_DESC]);
//        }

//        $products = $model->getProducts()->orderBy(['remains' => SORT_DESC]);

//        $joinedQuery = $model->getProducts()->where(['>','remains',0]);
//        $joinedQuery = $joinedQuery->union($model->getProducts()->where(['remains' => 0]));

//        $products = $model->getProducts()->where(['>','remains',0]);
//        $products2 = $model->getProducts()->where(['remains' => 0]);
//
//        $products->orWhere($products2->where);
//        $products->addParams($products2->params);





//        $products = new SqlDataProvider([
//            'sql' => $products->createCommand()->rawSql,
//            //'totalCount' => $joinedQuery->count(),
//        ]);

//        $pagination = $products->getPagination();

//        $pagination = new Pagination([
//            'defaultPageSize' => 20,
//            'totalCount' => $products->count(),
//        ]);
//
//        $products = $products->offset($pagination->offset)->limit($pagination->limit)->all();

//        $products = $products->getModels();

//        $dataProvider = new ActiveDataProvider([
//            'query' => $joinedQuery,
//            'pagination' => [
//                'pageSize' => 20,
//            ],
//        ]);



//
//        return $this->render('view', [
//            'model' => $model,
//            'products' => $products,
//            'pagination' => $pagination,
//            //'products' => $dataProvider->getModels(),
//            //'pagination' => $dataProvider->getPagination(),
//        ]);







        $products1 = $model->getProducts()->where(['>','remains',0])->orderBy(['price' => SORT_DESC])->asArray()->all();
        $products2 = $model->getProducts()->where(['remains' => 0])->orderBy(['price' => SORT_DESC])->asArray()->all();

        $products = array_merge($products1, $products2);

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



//        $products1 = $model->getProducts()->where(['>','remains',0])->orderBy(['price' => SORT_DESC]);
//        $products2 = $model->getProducts()->where(['remains' => 0])->orderBy(['price' => SORT_DESC]);
//
//        $products = $products1->union($products2);
//
//        $dataProvider = new ActiveDataProvider([
//            'query' => $products,
//            'pagination' => [
//                'pageSize' => 20,
//            ],
//        ]);
//
//        $pagination = new Pagination([
//            'defaultPageSize' => 20,
//            'totalCount' => $dataProvider->getTotalCount(),
//        ]);
//
//        $products = $dataProvider->getModels();



//        echo '<pre>';
//        var_dump($products);
//        echo '</pre>';


//        $products = $model->getProducts()->orderBy(['remains' => SORT_DESC])->addOrderBy(['price' => SORT_DESC]);
//
//        $pagination = new Pagination([
//            'defaultPageSize' => 20,
//            'totalCount' => $products->count(),
//        ]);
//
//        $products = $products->offset($pagination->offset)->limit($pagination->limit)->all();
//
        return $this->render('view', [
            'model' => $model,
            'products' => $products,
            'pagination' => $pagination,
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
