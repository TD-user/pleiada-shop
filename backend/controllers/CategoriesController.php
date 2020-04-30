<?php

namespace backend\controllers;

use backend\models\UploadFormCategories;
use backend\models\XmlCategory;
use Yii;
use common\models\Categories;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

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
            'access' => [
                'class' => AccessControl::className(),
                'denyCallback' => function () {
                    $this->goHome();
                },
                'rules' => [
                    [
                        'actions' => ['index','view','create','update','delete','upload','delete-img'],
                        'allow' => true,
                        'roles' => ['superAdmin','admin'],
                    ],

                ],
            ],
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
        $dataProvider = new ActiveDataProvider([
            'query' => Categories::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Categories model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Categories model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Categories();

        $parent_categories = Categories::find()->where(['id_parent' => 0])->all();
        $parent_categories = ArrayHelper::map($parent_categories, 'id', 'name');
        $parent_categories[0] = "не обрано, буде створено батьківську категорію";

        $modelUpload = new UploadFormCategories();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            if($model->id_parent == 0) {
                $modelUpload->category = $model;

                if (Yii::$app->request->post()) {
                    $modelUpload->imageFile = UploadedFile::getInstances($modelUpload, 'imageFile');
                    $modelUpload->upload();
                }
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'parent_categories' => $parent_categories,
            'modelUpload' => $modelUpload
        ]);
    }

    /**
     * Updates an existing Categories model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $parent_categories = Categories::find()->where(['id_parent' => 0])->all();
        $parent_categories = ArrayHelper::map($parent_categories, 'id', 'name');
        $parent_categories[0] = "не обрано, буде створено батьківську категорію";

        $modelUpload = new UploadFormCategories();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            if($model->id_parent == 0) {
                $modelUpload->category = $model;

                if (Yii::$app->request->post()) {
                    $modelUpload->imageFile = UploadedFile::getInstances($modelUpload, 'imageFile');
                    $modelUpload->upload();
                }
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'parent_categories' => $parent_categories,
            'modelUpload' => $modelUpload
        ]);
    }

    /**
     * Deletes an existing Categories model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = new XmlCategory();
        if ($model->getProduct($id)!=null )
        {
            Yii::$app->session->setFlash('error', 'Категорію не можливо видалити тому що у ній є товари');
            return $this->redirect(array('index','param1'=>'val1'));
        }
        else if ($model->getCategories($id)!=null)
        {
            Yii::$app->session->setFlash('error','Категорію не можливо видалити тому що у ній є підкатегорії');
            return $this->redirect(array('index','param1'=>'val1'));
        }
        else {
        $this->findModel($id)->delete();
            return $this->redirect(['index']);
        }

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

    public function actionUpload()
    {
        $model = new XmlCategory();
        $process = '';
        if (isset($_POST['XmlCategory'])) {
            $model->path = UploadedFile::getInstance($model, 'path');

            if ($model->ArrayToDB())
                $process = "Файл успішно завантажений !";
            else
                $process = "Файл не валідний !";
        }

        return $this->render('updatebd',['model'=>$model,'process'=>$process]);
    }

    public function actionDeleteImg($id)
    {
        if(!Yii::$app->request->isAjax)
            return $this->goHome();

        $model = $this->findModel($id);
        $model->deleteImg();
        $model->img_url = null;
        $model->save();
        return true;

    }
}
