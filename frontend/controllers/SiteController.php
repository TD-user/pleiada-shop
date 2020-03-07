<?php
namespace frontend\controllers;

use common\models\History;
use common\models\Htmlpages;
use common\models\Mainslider;
use common\models\Product;
use common\models\Social;
use common\models\Subscriber;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\data\ArrayDataProvider;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
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
            ->orderBy(['remains' => SORT_DESC])
            ->limit(8)
            ->all();

        $watchedProducts = null;
        $cookies = Yii::$app->request->cookies;
        if ($cookies->has('watchedProducts')) {
            $watchedProducts = $cookies->getValue('watchedProducts');
            $watchedProducts = explode(',', $watchedProducts);
            $watchedProducts = array_unique($watchedProducts);
            $watchedProducts = array_slice($watchedProducts, 0, 120);
            $cookies = Yii::$app->response->cookies;
            $cookies->add(new \yii\web\Cookie([
                'name' => 'watchedProducts',
                'value' => implode(',', $watchedProducts),
                'expire' => time() + 86400 * 365,
            ]));
            $watchedProducts = Product::find()->where(['in', 'id', $watchedProducts])->limit(8)->all();
        }

        $mainSlider = Mainslider::find()->all();
        $mainSliderCount = Mainslider::find()->count();

        $mostBuying = History::find()
            ->select(['product_id', 'COUNT(product_id) as C'])
            ->groupBy(['product_id'])
            ->orderBy(['C' => SORT_DESC])
            ->asArray()
            ->all();

        $mostBuying = ArrayHelper::getColumn($mostBuying, 'product_id');

//        echo '<pre>';
//        var_dump($mostBuying);
//        echo '</pre>';

        $popular = Product::find()
            ->where(['in', 'id', $mostBuying])
            ->limit(8)
            ->all();

//        echo '<pre>';
//        var_dump($popular);
//        echo '</pre>';

//        $popular = null;

        return $this->render('index', [
            'categories' => $categories,
            'promotionProducts' => $promotionProducts,
            'watchedProducts' => $watchedProducts,
            'popularProducts' => $popular,
            'mainSlider' => $mainSlider,
            'mainSliderCount' => $mainSliderCount,
        ]);
    }

    public function actionAllPromotionProducts()
    {
//        $promotionProducts = Product::find()
//            ->where(['not', ['promotionPrice' => null]])
//            ->andWhere(['not', ['promotionPrice' => 0]])
//            ->orderBy(['remains' => SORT_DESC]);
//
//        $paginationPromo = new Pagination([
//            'defaultPageSize' => 20,
//            'totalCount' => $promotionProducts->count(),
//        ]);
//
//        $promotionProducts = $promotionProducts->offset($paginationPromo->offset)->limit($paginationPromo->limit)->all();
//
//        return $this->render('promotion', [
//            'products' => $promotionProducts,
//            'pagination' => $paginationPromo,
//        ]);

        $products1 = Product::find()
            ->where(['>','remains',0])
            ->andWhere(['not', ['promotionPrice' => null]])
            ->andWhere(['not', ['promotionPrice' => 0]])
            ->orderBy(['price' => SORT_DESC])
            ->asArray()
            ->all();

        $products2 = Product::find()
            ->where(['remains' => 0])
            ->andWhere(['not', ['promotionPrice' => null]])
            ->andWhere(['not', ['promotionPrice' => 0]])
            ->orderBy(['price' => SORT_DESC])
            ->asArray()
            ->all();

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

        return $this->render('promotion', [
            'products' => $products,
            'pagination' => $pagination,
        ]);
    }

    public function actionAllPopularProducts()
    {
        $mostBuying = History::find()
            ->select(['product_id', 'COUNT(product_id) as C'])
            ->groupBy(['product_id'])
            ->orderBy(['C' => SORT_DESC])
            ->asArray()
            ->all();

        $mostBuying = ArrayHelper::getColumn($mostBuying, 'product_id');

        $popular = Product::find()->where(['in', 'id', $mostBuying]);

        $pagination = new Pagination([
            'defaultPageSize' => 20,
            'totalCount' => $popular->count(),
        ]);

        $popular = $popular->offset($pagination->offset)->limit($pagination->limit)->all();

        return $this->render('popular', [
            'products' => $popular,
            'pagination' => $pagination,
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
        $page = Htmlpages::findOne(1);

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
            Yii::$app->session->setFlash('success', 'Пароль успішно змінено');

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
        $page = Htmlpages::findOne(3);

        return $this->render('vacancy', [
            'page' => $page,
        ]);
    }
    
    public function actionContacts()
    {
        $page = Htmlpages::findOne(7);

        return $this->render('contacts', [
            'page' => $page,
        ]);
    }    
    
    public function actionDeliveryAndPayment()
    {
        $page = Htmlpages::findOne(2);

        return $this->render('delivery', [
            'page' => $page,
        ]);
    }
    
    public function actionReturnOfGoods()
    {
        $page = Htmlpages::findOne(4);

        return $this->render('returnOfGoods', [
            'page' => $page,
        ]);
    }
    
    public function actionTermsOfUse()
    {
        $page = Htmlpages::findOne(5);

        return $this->render('termsOfUse', [
            'page' => $page,
        ]);
    }

    public function actionSubscribe()
    {
        if(!Yii::$app->request->isPost)
            return $this->goHome();

        $model = new Subscriber();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Дякуємо за підписку, на вказану пошту будуть надходити листи про оновлення асортименту, акції, знижки та новини');
        }
        else {
            $message = isset($model->errors['email'][0]) ? $model->errors['email'][0] : 'Під час оформлення підписки виникли деякі проблеми. Можливо ви використали невалідний email або на нього вже оформлено підписку';
            Yii::$app->session->setFlash('error', $message);
        }
        return $this->goHome();
    }
    
    
}
