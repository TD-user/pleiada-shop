<?php
namespace backend\controllers;

use backend\models\ImgToDb;
use backend\models\SignUpAdmin;
use backend\models\XmlToDB;
use Yii;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\LoginFormAdmin;
use yii\web\UploadedFile;

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
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['upload'],
                        'allow' => true,
                        'roles' => ['superAdmin','admin','manager'],
                    ],

                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['img'],
                        'allow' => true,
                        'roles' => ['superAdmin','admin','manager'],
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
       return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
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

    public function actionUpload()
    {
        $model = new XmlToDB();
        $processIMG = ''; $process = '';
            if ($model->load(Yii::$app->request->post())){

                $model->path = UploadedFile::getInstance($model, 'path');

                if ($model->ArrayToDB())
                    $process = "Файл успішно завантажений !";
                else
                    $process = "Файл не валідний !";
            }
                return $this->render('updatebd',['model'=>$model,'process'=>$process,'processIMG'=>$processIMG]);
    }


    public function actionImg()
    {
        $model = new XmlToDB();
        $process = $processIMG = '';

            if ($model->setImgToDb())
                $processIMG = "Файли успішно додані!";

        return $this->render('updatebd',['model'=>$model,'process'=>$process,'processIMG'=>$processIMG]);
    }



}
