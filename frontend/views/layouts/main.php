<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\widgets\SocialWidget;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="icon" href="/img/icon.ico" sizes="16x16" type="image/png">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Ubuntu&display=swap" rel="stylesheet">
</head>
<body>
<?php $this->beginBody() ?>
<div class="side-menu">
    <div class="side-header">
        <a href="/">
            <img src="/img/logo.png" alt="Плеяда - магазин канцтоварів" title="Плеяда - магазин канцтоварів" height="60" width="160">
        </a>
        <span class="side-close">&#10006;</span>
    </div>
    <ul class="side-nav">
        <li class="side-li-sep"><a href="<?= Url::to(['categories/index'])?>">Каталог товарів</a></li>
        <?php if(!Yii::$app->user->isGuest):?>
        <li>
            <div class="side-logo">
                <img src="/img/profile-dark.png" alt="Особистий кабінет">
            </div>
            <a href="<?= Url::to(['user/index'])?>">Особистий кабінет</a>
        </li>
        <?php endif ?>
        <li>
            <div class="side-logo">
                <img src="/img/curt-dark.png" alt="Особистий кабінет">
            </div>
            <a href="<?= Url::to(['user/cart'])?>">Корзина</a>
        </li>
        <?php if(!Yii::$app->user->isGuest):?>
        <li class="side-li-sep">
            <div class="side-logo">
                <img src="/img/favorite-dark.png" alt="Особистий кабінет">
            </div>
            <a href="<?= Url::to(['user/favourite'])?>">Улюблені</a>
        </li>
        <?php endif ?>
        <li><a href="<?= Url::to(['site/contacts'])?>">Контакти</a></li>
        <li><a href="<?= Url::to(['site/delivery-and-payment'])?>">Доставка</a></li>
        <li><a href="<?= Url::to(['site/vacancy'])?>">Вільні вакансії</a></li>
        <li><a href="<?= Url::to(['site/about'])?>">Про нас</a></li>
        <?php if(Yii::$app->user->isGuest):?>
        <li><a href="<?= Url::to(['site/signup'])?>">Реєстрація</a></li>
        <li><a href="<?= Url::to(['site/login'])?>">Вхід</a></li>
        <?php else:?>
        <li><?=
            Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Вихід ('.Yii::$app->user->identity->username.')', array('class' => 'sm-btn-author')
            )
            . Html::endForm()?></li>
        <?php endif ?>
    </ul>
</div>
<header>
    <div class="hamburger">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <div class="header-logo">
        <span>Канцтовари</span>
        <a href="/">
            <img src="/img/logo.png" alt="Плеяда - магазин канцтоварів" title="Плеяда - магазин канцтоварів" height="60" width="160">
        </a>
    </div>
    <div class="header-info">
        <div class="header-helper">
            <div class="header-menu">
                <ul class="header-list">
                    <li><a href="<?= Url::to(['site/contacts'])?>">контакти</a></li>
                    <li><a href="<?= Url::to(['site/delivery-and-payment'])?>">доставка</a></li>
                    <li><a href="<?= Url::to(['site/vacancy'])?>">вільні вакансії</a></li>
                    <li><a href="<?= Url::to(['site/about'])?>">про нас</a></li>
                    <?php if(Yii::$app->user->isGuest):?>
                    <li><a href="<?= Url::to(['site/signup'])?>">реєстрація</a></li>
                    <li><a href="<?= Url::to(['site/login'])?>">вхід</a></li>
                    <?php else:?>
                    <li><a href="<?= Url::to(['user/index'])?>">кабінет</a></li>
                    <li><?=
                        Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton(
                            'вихід ('.Yii::$app->user->identity->username.')', array('class' => 'btn-authorization')
                        )
                        . Html::endForm()?></li>
                    <?php endif ?>
                </ul>
                <div class="header-numbers">
                    <span>+38 (067) 208 0241 / +38 (032) 476 6190</span>
                </div>
            </div>
            <div class="header-another">
                <form action="<?= Url::to(['/product/search'])?>" method="get" class="find">
                    <input type="text" name="q" placeholder="Я шукаю..." required>
                    <span class="find-close">&#10006;</span>
                    <button type="submit">Знайти</button>
                </form>
                <div class="header-icons">
                    <?php if(!Yii::$app->user->isGuest):?>
                    <a href="<?= Url::to(['user/favourite'])?>">
                        <img src="/img/favorite.png" alt="Улюблені" title="Улюблені" height="40" width="40">
                        <span class="favourite-counter">
                            <?php if(Yii::$app->user->identity->getFavourites()->count() > 0):?>
                                <?= Yii::$app->user->identity->getFavourites()->count(); ?>
                            <?php endif; ?>
                        </span>
                    </a>
                    <?php endif ?>
                    <a href="<?= Url::to(['user/cart'])?>">
                        <img src="/img/curt.png" alt="Корзина" title="Корзина" height="40" width="40">
                        <span class="cart-counter">
                            <?php if(!Yii::$app->user->isGuest and Yii::$app->user->identity->getCarts()->count() > 0):?>
                                <?= Yii::$app->user->identity->getCarts()->count(); ?>
                            <?php endif; ?>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="main-container-2">
    <div class="container">
        <div class="row">
            <div class="col-sm-12" style="margin-top: 15px">
                <?= Alert::widget() ?>
            </div>
        </div>
    </div>
</div>
<div class="main-container">
    <?= $content ?>
</div>
    
<footer>
    <div class="footer-container">
        <?= SocialWidget::widget(); ?>
        <div class="footer-navigation">
            <ul class="footer-list">
                <li><a href="<?= Url::to(['site/delivery-and-payment'])?>">Доставка та оплата</a></li>
                <li><a href="<?= Url::to(['site/return-of-goods'])?>">Повернення товару</a></li>
            </ul>
            <ul class="footer-list">
                <li><a href="<?= Url::to(['site/about'])?>">Про нас</a></li>
                <li><a href="<?= Url::to(['site/terms-of-use'])?>">Умови використання сайту</a></li>
            </ul>
            <ul class="footer-list">
                <li><a href="<?= Url::to(['site/vacancy'])?>">Вакансії</a></li>
                <li><a href="<?= Url::to(['site/contacts'])?>">Контакти</a></li>
            </ul>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
