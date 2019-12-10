<?php
namespace frontend\controllers;

use common\models\Htmlpages;
use common\models\Mainslider;
use common\models\Product;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\data\Pagination;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\Categories;

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
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        if ( strcmp(array_keys(Yii::$app->authManager->getRolesByUser(Yii::$app->user->id))[0],'baned') ===0)
        {
            Yii::$app->user->logout();
            Yii::$app->session->setFlash('error', 'Нажаль ви були заблоковані! Зв\'яжітись з нами у розділі Контакти');
        }
        $categories = Categories::getTreeMenuArray();

        $promotionProducts = Product::find()
            ->where(['not', ['promotionPrice' => null]])
            ->andWhere(['not', ['promotionPrice' => 0]])
            ->orderBy(['remains' => SORT_DESC]);

        $paginationPromo = new Pagination([
            'defaultPageSize' => 8,
            'totalCount' => $promotionProducts->count(),
        ]);

        $promotionProducts = $promotionProducts->offset($paginationPromo->offset)->limit($paginationPromo->limit)->all();

        $watchedProducts = null;
        $cookies = Yii::$app->request->cookies;
        if ($cookies->has('watchedProducts')) {
            $watchedProducts = $cookies->getValue('watchedProducts');
            $watchedProducts = explode(',', $watchedProducts);
            $watchedProducts = array_unique($watchedProducts);
            $watchedProducts = array_slice($watchedProducts, 0, 12);
            $cookies = Yii::$app->response->cookies;
            $cookies->add(new \yii\web\Cookie([
                'name' => 'watchedProducts',
                'value' => implode(',', $watchedProducts),
            ]));
            $watchedProducts = Product::find()->where(['in', 'id', $watchedProducts])->limit(12)->all();
        }

        $mainSlider = Mainslider::find()->all();
        $mainSliderCount = Mainslider::find()->count();

        return $this->render('index', [
            'categories' => $categories,
            'promotionProducts' => $promotionProducts,
            'paginationPromo' => $paginationPromo,
            'watchedProducts' => $watchedProducts,
            'mainSlider' => $mainSlider,
            'mainSliderCount' => $mainSliderCount,
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
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
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        return $this->goHome();
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        $page = Htmlpages::find()->where(['alias' => 'pro-nas'])->one();

        return $this->render('about', [
            'page' => $page,
        ]);
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Дякуємо за реєстрацію на нашому сайті. Залишилось лише скористайтеся формою входу.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'На ваш email направлено лист з подальшими інструкціями');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Вибачте, ми не можемо відправити відновлення паролю на вказану вами адресу.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Новий пароль змінено');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
    
     /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionVacancy()
    {
        $page = Htmlpages::find()->where(['alias' => 'vakansii'])->one();

        return $this->render('vacancy', [
            'page' => $page,
        ]);
    }
    
    public function actionContacts()
    {
        return $this->render('contacts');
    }    
    
    public function actionDeliveryAndPayment()
    {
        $page = Htmlpages::find()->where(['alias' => 'dostavka-ta-oplata'])->one();

        return $this->render('delivery', [
            'page' => $page,
        ]);
    }
    
    public function actionReturnOfGoods()
    {
        $page = Htmlpages::find()->where(['alias' => 'povernennia-tovaru'])->one();

        return $this->render('returnOfGoods', [
            'page' => $page,
        ]);
    }
    
    public function actionTermsOfUse()
    {
        $page = Htmlpages::find()->where(['alias' => 'umovy-vykorystannia-saitu'])->one();

        return $this->render('termsOfUse', [
            'page' => $page,
        ]);
    }
    
    
}
