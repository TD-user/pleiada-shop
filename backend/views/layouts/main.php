<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Головна', 'url' => ['/site/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Вхід', 'url' => ['/site/login']];
    } else {

        if (Yii::$app->user->can('canAdmin')) {
            $menuItems[] = [
                'label' => 'Контент',
                'items' => [
                    ['label' => 'Вміст сторінок', 'url' => ['/page/index']],
                    ['label' => 'Головний слайдер', 'url' => ['/mainslider/index']],
                    ['label' => 'Соціальні мережі', 'url' => ['/social/index']],
                ],
            ];
            $menuItems[] = [
                'label' => 'Розсилка',
                'items' => [
                    ['label' => 'Розсилка', 'url' => ['/letter/index']],
                    ['label' => 'Шаблони листів', 'url' => ['/lettertemplate/index']],
                ],
            ];
        }
        if (Yii::$app->user->can('canManage')) {
            $menuItems[] = [
                'label' => 'Замовлення',
                'items' => [
                    ['label' => 'One click замовлення', 'url' => ['/oneclickorder/index']],
                    ['label' => 'Замовлення', 'url' => ['/order/index']],

                ],
            ];
        }
        if (Yii::$app->user->can('canAdmin'))
        $menuItems[] = [
            'label' => 'Товари',
            'items' => [
                ['label' => 'Категорії', 'url' => ['/categories/index']],
                ['label' => 'Оновити Категорії','url'=>['categories/upload']],
                ['label' => 'Додати категорію', 'url' => ['/categories/create']],
                ['label' => 'Товари', 'url' => ['/product/index']],
                ['label' => 'Додати товар', 'url' => ['/product/create']],
                ['label' => 'Оновити Товари', 'url' => ['/site/upload']]
            ],
        ];
        if (Yii::$app->user->can('canModerate'))
        $menuItems[] = [
            'label' => 'Відгуки',
            'items' => [
                ['label' => 'Нові відгуки', 'url' => ['/reviews/new']],
                ['label' => 'Усі відгуки', 'url' => ['/reviews/index']]
            ],
        ];
        if (Yii::$app->user->can('allAdmin'))
        $menuItems[] = [
            'label' => 'Налаштування',
            'items' => [
                ['label' => 'Адміністратори', 'url' => ['/admin/index']],
                ['label' => 'Користувачі', 'url' => ['/user/index']],
                ['label' => 'Підписники', 'url' => ['/subscriber/index']],

            ],
        ];

        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Вихід (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

<!--        <p class="pull-right">--><?//= Yii::powered() ?><!--</p>-->
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
