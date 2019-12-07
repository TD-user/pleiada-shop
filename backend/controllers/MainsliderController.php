<?php

namespace backend\controllers;

use backend\models\UploadFormMainSlider;
use Yii;
use common\models\Mainslider;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * MainsliderController implements the CRUD actions for Mainslider model.
 */
class MainsliderController extends Controller
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
     * Lists all Mainslider models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Mainslider::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Mainslider model.
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
     * Creates a new Mainslider model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Mainslider();

        $modelUpload = new UploadFormMainSlider();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $modelUpload->image = $model;

            if (Yii::$app->request->post()) {
                $modelUpload->imageFile = UploadedFile::getInstances($modelUpload, 'imageFile');
                if(!$modelUpload->upload()) {
                    $model->delete();
                    Yii::$app->session->setFlash('error', 'Файл з таким імя\'м вже існує');
                    return $this->redirect(['index']);
                }
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'modelUpload' => $modelUpload,
        ]);
    }

    /**
     * Updates an existing Mainslider model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $modelUpload = new UploadFormMainSlider();
        $modelUpload->image = $model;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            if (Yii::$app->request->post()) {
                $modelUpload->imageFile = UploadedFile::getInstances($modelUpload, 'imageFile');
                $modelUpload->upload();
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'modelUpload' => $modelUpload,
        ]);
    }

    /**
     * Deletes an existing Mainslider model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Mainslider model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Mainslider the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mainslider::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
