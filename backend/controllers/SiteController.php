<?php
namespace backend\controllers;

use backend\models\SignUpAdmin;
use backend\models\XmlToDB;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\LoginFormAdmin;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error','signup'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        //todo: не забути стекрти
//        $dbxml = new XmlToDB();
//        $dbxml->path = __DIR__.'\1c2site.xml';
//        $dbxml->ArrayToDB();
//      -----------Створення ролей для RBAC--------
//        $role = Yii::$app->authManager->createRole('admin');
//        $role->description = 'Администратор';
//        Yii::$app->authManager->add($role);
//
//        $role = Yii::$app->authManager->createRole('super admin');
//        $role->description = 'Супер Адміністратор';
//        Yii::$app->authManager->add($role);
//
//        $role = Yii::$app->authManager->createRole('moderator');
//        $role->description = 'Модератор';
//        Yii::$app->authManager->add($role);
//
//        $role = Yii::$app->authManager->createRole('manager');
//        $role->description = 'Менеджер';
//        Yii::$app->authManager->add($role);

        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
//    public function actionLogin()
//    {
//        if (!Yii::$app->user->isGuest) {
//            return $this->goHome();
//        }
//
//        $model = new LoginForm();
//        if ($model->load(Yii::$app->request->post()) && $model->login()) {
//            return $this->goBack();
//        } else {
//            $model->password = '';
//
//            return $this->render('login', [
//                'model' => $model,
//            ]);
//        }
//    }
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {


            return $this->goHome();
        }

        $model = new LoginFormAdmin();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }

    }
    public function actionSignup()
    {
        $model = new SignUpAdmin();
        if (isset($_POST['SignUpAdmin']))
        {
            $model->attributes = Yii::$app->request->post('SignUpAdmin');
            if ($model->validate() && $model->signup()) {

                return $this->goHome();
            }
        }
        return $this->render('signup',['model'=>$model]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
