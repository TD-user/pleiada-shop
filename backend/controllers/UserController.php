<?php

namespace backend\controllers;


use Yii;
use common\models\User;
use common\models\UserSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\UpdateUser;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
            'access' => [
                'class' => AccessControl::className(),
                'denyCallback' => function () {
                    $this->goHome();
                },
                'rules' => [
                    [
                        'actions' => ['index','view','create','update','delete','bane','unbane'],
                        'allow' => true,
                        'roles' => ['superAdmin'],

                    ],

                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */


    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $modeluser = $this->findModel($id);
        $model= new UpdateUser();
        $model->id = $modeluser->id;
        $model->email = $modeluser->email;
        $model->phone = $modeluser->phone;
        $model->surname = $modeluser->surname;
        $model->name = $modeluser->name;
        $model->fathername = $modeluser->fathername;
        $model->birthday = $modeluser->birthday;
        $model->gender = $modeluser->gender;
        $model->city = $modeluser->city;
        $model->username = $modeluser->username;

//        $model->id = $modeluser->id;
//        $model->password_hash = $modeluser->password_hash;
//        $model->verification_token = $modeluser->verification_token;
//        $model->password_hash = $modeluser->password_hash;
//        $model->auth_key = $modeluser->auth_key;
//        $model->username = $modeluser->username;
//        $model->status = $modeluser->status;
//        $model->created_at = $modeluser->created_at;
//        $model->updated_at = $modeluser->updated_at;


      if ($model->load(Yii::$app->request->post())) {
                $model->userUpdate($id);
            return $this->redirect(['view', 'id' => $id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function  actionBane($id)
    {
        $userRole = Yii::$app->authManager->getRole('baned');
        Yii::$app->authManager->assign($userRole,$id);

        return $this->redirect('index');
    }
    public function  actionUnbane($id)
    {
        $manager = Yii::$app->authManager;
        $item = $manager->getRole('baned');
        $manager->revoke($item,$id);

        return $this->redirect('index');
    }
}
