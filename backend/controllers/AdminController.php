<?php

namespace backend\controllers;

use backend\models\SignUpAdmin;
use backend\models\UpdateAdmin;
use Yii;
use backend\models\Admin;
use backend\models\AdminSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdminController implements the CRUD actions for Admin model.
 */
class AdminController extends Controller
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
                        'actions' => ['index','view','create','update','delete'],
                        'allow' => true,
                        'roles' => ['superAdmin'],

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
     * Lists all Admin models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdminSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Admin model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),'role' =>array_keys(Yii::$app->authManager->getRolesByUser($id))[0]
        ]);
    }

    /**
     * Creates a new Admin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $model = new SignUpAdmin();
        if ($model->load(Yii::$app->request->post()))
        {
            if ( $model->signup()) {
                   $sa= Admin::findByUsername($model->username);
                   $userRole = Yii::$app->authManager->getRole($model->role);
                    Yii::$app->authManager->assign($userRole, $sa->id);
                return $this->redirect(['view', 'id' => $sa->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Admin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

        $modeladmin = $this->findModel($id);
        $model = new UpdateAdmin();


        if ($model->load(Yii::$app->request->post())) {
                $model->update($id);
            return $this->redirect(['view', 'id' => $id]);
        }
        $model->username = $modeladmin->username;
        $model->auth_key = $modeladmin->auth_key;
        $model->fio =$modeladmin->fio;
        $model->role = array_keys(Yii::$app->authManager->getRolesByUser($id))[0];

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Admin model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {

        $manager = Yii::$app->authManager;
        $role = array_keys($manager->getRolesByUser($id))[0];
        $item = $manager->getRole($role);
        $manager->revoke($item,$id);
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Admin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Admin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Admin::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
