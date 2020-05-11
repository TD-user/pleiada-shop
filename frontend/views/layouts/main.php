<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\widgets\SocialWidget;
use frontend\widgets\subscribeForm;
use frontend\widgets\phonesForHeader;

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
        <?php if(!Yii::$app->user->isGuest):?>
        <li>
            <div class="side-logo">
                <img src="/img/curt-dark.png" alt="Особистий кабінет">
            </div>
            <a href="<?= Url::to(['user/cart'])?>">Корзина</a>
        </li>
        <?php endif ?>
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
                    <?= phonesForHeader\PhonesForHeaderWidget::widget(); ?>
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
                    <a href="<?= Url::to(['user/cart'])?>">
                        <img src="/img/curt.png" alt="Корзина" title="Корзина" height="40" width="40">
                        <span class="cart-counter">
                            <?php if(!Yii::$app->user->isGuest and Yii::$app->user->identity->getCarts()->count() > 0):?>
                                <?= Yii::$app->user->identity->getCarts()->count(); ?>
                            <?php endif; ?>
                        </span>
                    </a>
                    <?php endif ?>
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

<div class="mp-toasts__wrapper"></div>
<footer>
    <?= subscribeForm\SubscribeFormWidget::widget(); ?>
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
    <div class="footer-numbers">
        <?= phonesForHeader\PhonesForHeaderWidget::widget(); ?>
    </div>
    <div class="copyright-block">
        <small>Copyright &copy; 2019-<?= date('Y'); ?> ТзОВ "....." pleiada.com.ua <br> Всі права захищено</small>
        <div class="by-main-page">
            <a href="https://www.mainpage.com.ua/" target="_blank">
                <svg version="1.1" id="lay_1"
                     xmlns="http://www.w3.org/2000/svg"
                     xmlns:xlink="http://www.w3.org/1999/xlink"
                     x="0px" y="0px" viewBox="0 0 85 14"
                     style="enable-background:new 0 0 85 14;"
                     xml:space="preserve">
                <style type="text/css">
                    .st0{fill: #690a62;}
                    .st1{fill:#000000;}
                </style>
                    <g>
                        <path class="st1" d="M2.3,10.7c-0.6,0-1.1-0.3-1.4-0.9C0.5,9.3,0.3,8.4,0.3,7.3c0-1.1,0.2-2,0.5-2.6c0.3-0.6,0.8-0.9,1.4-0.9
			c0.4,0,0.7,0.1,1,0.2L3,4.5C2.8,4.4,2.5,4.3,2.3,4.3c-0.9,0-1.4,1-1.4,2.9c0,1.9,0.5,2.9,1.4,2.9c0.3,0,0.6-0.1,0.9-0.2v0.5
			c-0.1,0.1-0.3,0.1-0.5,0.2S2.4,10.7,2.3,10.7z"/>
                        <path class="st1" d="M6.1,3.8c0.2,0,0.4,0,0.6,0.1L6.5,4.4C6.4,4.4,6.3,4.3,6.1,4.3c-0.2,0-0.4,0.1-0.6,0.3s-0.3,0.6-0.4,1
			C5,6.1,4.9,6.5,4.9,7v3.6H4.4V3.9h0.5l0.1,1.2h0C5.2,4.2,5.6,3.8,6.1,3.8z"/>
                        <path class="st1" d="M9.4,10.7c-0.7,0-1.2-0.3-1.5-0.9C7.5,9.2,7.3,8.4,7.3,7.3c0-1.1,0.2-2,0.5-2.6c0.3-0.6,0.8-0.9,1.4-0.9
			c0.5,0,0.9,0.3,1.2,0.8c0.3,0.5,0.5,1.2,0.5,2.1v0.5h-3c0,1,0.1,1.7,0.4,2.2c0.3,0.5,0.6,0.7,1.2,0.7c0.4,0,0.8-0.1,1.3-0.4v0.6
			C10.3,10.6,9.9,10.7,9.4,10.7z M9.2,4.3C8.4,4.3,8,5.1,7.9,6.7h2.4C10.4,6,10.3,5.4,10,5S9.5,4.3,9.2,4.3z"/>
                        <path class="st1" d="M14.8,10.6l-0.1-0.9h0c-0.3,0.7-0.8,1.1-1.4,1.1c-0.4,0-0.7-0.2-1-0.5s-0.4-0.8-0.4-1.4c0-0.6,0.2-1.1,0.5-1.5
			s0.9-0.6,1.5-0.6l0.7,0V6.1c0-0.6-0.1-1.1-0.2-1.4s-0.4-0.4-0.7-0.4c-0.4,0-0.7,0.1-1.1,0.4l-0.2-0.5c0.4-0.3,0.9-0.4,1.4-0.4
			c0.5,0,0.9,0.2,1.1,0.5c0.2,0.3,0.3,0.9,0.3,1.7v4.6H14.8z M13.4,10.2c0.4,0,0.7-0.2,0.9-0.6c0.2-0.4,0.3-1,0.3-1.8V7.1l-0.7,0
			c-0.5,0-0.9,0.2-1.1,0.4c-0.2,0.3-0.4,0.7-0.4,1.2c0,0.5,0.1,0.8,0.2,1.1C12.9,10.1,13.2,10.2,13.4,10.2z"/>
                        <path class="st1" d="M18.1,10.2c0.2,0,0.3,0,0.5-0.1v0.5c-0.2,0.1-0.4,0.1-0.7,0.1c-0.7,0-1-0.5-1-1.5V4.4h-0.6V4.1l0.6-0.2l0.2-1.6h0.4v1.6
			h1v0.5h-1V9c0,0.5,0,0.8,0.1,0.9C17.7,10.1,17.9,10.2,18.1,10.2z"/>
                        <path class="st1" d="M21.4,10.7c-0.7,0-1.2-0.3-1.5-0.9c-0.4-0.6-0.5-1.4-0.5-2.5c0-1.1,0.2-2,0.5-2.6c0.3-0.6,0.8-0.9,1.4-0.9
			c0.5,0,0.9,0.3,1.2,0.8c0.3,0.5,0.5,1.2,0.5,2.1v0.5h-3c0,1,0.1,1.7,0.4,2.2c0.3,0.5,0.6,0.7,1.2,0.7c0.4,0,0.8-0.1,1.3-0.4v0.6
			C22.2,10.6,21.8,10.7,21.4,10.7z M21.1,4.3c-0.8,0-1.2,0.8-1.3,2.4h2.4C22.3,6,22.2,5.4,22,5S21.5,4.3,21.1,4.3z"/>
                        <path class="st1" d="M25.8,10.7c-1.2,0-1.9-1.2-1.9-3.5c0-1.1,0.2-2,0.5-2.6s0.8-0.9,1.4-0.9c0.3,0,0.6,0.1,0.8,0.3c0.3,0.2,0.5,0.4,0.6,0.7
			h0l0-0.7V1h0.6v9.6h-0.5l0-0.9h-0.1c-0.2,0.3-0.3,0.6-0.6,0.8C26.4,10.6,26.1,10.7,25.8,10.7z M25.8,10.2c0.4,0,0.8-0.2,1-0.7
			c0.2-0.4,0.4-1.1,0.4-1.9V7.3c0-1-0.1-1.8-0.3-2.2s-0.6-0.7-1.1-0.7c-0.5,0-0.8,0.3-1,0.8s-0.3,1.2-0.3,2.2c0,1,0.1,1.7,0.3,2.2
			C25.1,10,25.4,10.2,25.8,10.2z"/>
                        <path class="st1" d="M33.7,3.8c1.2,0,1.9,1.2,1.9,3.5c0,1.1-0.2,2-0.5,2.6s-0.8,0.9-1.3,0.9c-0.3,0-0.6-0.1-0.8-0.3c-0.3-0.2-0.5-0.4-0.6-0.8
			h0l-0.1,0.9h-0.5V1h0.6v3l0,0.8h0C32.7,4.1,33.1,3.8,33.7,3.8z M33.7,4.3c-0.5,0-0.8,0.2-1.1,0.7s-0.3,1.2-0.3,2.2v0.2
			c0,1.9,0.5,2.8,1.4,2.8c0.4,0,0.8-0.2,1-0.7S35,8.2,35,7.2c0-1-0.1-1.7-0.3-2.2S34.2,4.3,33.7,4.3z"/>
                        <path class="st1" d="M37.8,10.6l-1.6-6.7h0.6l1,4.2c0.1,0.5,0.2,1.1,0.3,1.7h0c0.1-0.5,0.2-1.1,0.3-1.7l0.9-4.2h0.6l-1.9,8
			c-0.1,0.6-0.3,1-0.5,1.3c-0.2,0.3-0.5,0.4-0.9,0.4c-0.1,0-0.3,0-0.5-0.1V13c0.2,0.1,0.3,0.1,0.5,0.1c0.2,0,0.4-0.1,0.6-0.3
			s0.3-0.6,0.4-1L37.8,10.6z"/>
                        <path class="st0" d="M46,10.6l-2.3-8.2h0c0,0.9,0.1,1.4,0.1,1.6v6.6h-0.6v-9H44l1.9,6.9c0.2,0.6,0.3,1.1,0.3,1.6h0
			c0-0.3,0.2-0.8,0.4-1.5l1.9-6.9h0.9v9h-0.6V4.1c0-0.3,0-0.8,0.1-1.7h0l-2.3,8.2H46z"/>
                        <path class="st0" d="M54.6,10.6l-0.8-3.3h-2.1L51,10.6h-0.6l2.1-9H53l2.1,9H54.6z M53.7,6.7l-0.8-3.4c-0.1-0.4-0.1-0.7-0.2-1.1
			c0,0.4-0.1,0.7-0.2,1.1l-0.7,3.4H53.7z"/>
                        <path class="st0" d="M56.1,10.6v-9h0.6v9H56.1z"/>
                        <path class="st0" d="M63,10.6h-0.7l-3.2-8.1h0c0,0.6,0.1,1.1,0.1,1.6v6.5h-0.6v-9h0.7l3.2,8h0c0-0.7,0-1.2,0-1.7V1.6H63V10.6z"/>
                        <path class="st1" d="M68.5,4.2c0,0.9-0.2,1.6-0.6,2.1c-0.4,0.4-1,0.7-1.8,0.7h-0.6v3.7h-0.6v-9h1.2c0.8,0,1.4,0.2,1.8,0.6
			C68.3,2.6,68.5,3.3,68.5,4.2z M65.5,6.3h0.6c0.7,0,1.1-0.2,1.4-0.5s0.4-0.9,0.4-1.6c0-0.7-0.1-1.3-0.4-1.6s-0.7-0.5-1.4-0.5h-0.6
			V6.3z"/>
                        <path class="st1" d="M73.1,10.6l-0.8-3.3h-2.1l-0.7,3.3h-0.6l2.1-9h0.6l2.1,9H73.1z M72.2,6.7l-0.8-3.4c-0.1-0.4-0.1-0.7-0.2-1.1
			c0,0.4-0.1,0.7-0.2,1.1l-0.7,3.4H72.2z"/>
                        <path class="st1" d="M77.4,6h1.9v4.3c-0.7,0.3-1.3,0.4-2,0.4c-0.9,0-1.7-0.4-2.2-1.2s-0.8-2-0.8-3.4c0-1.5,0.3-2.6,0.8-3.4
			c0.5-0.8,1.3-1.2,2.2-1.2c0.6,0,1.3,0.2,1.8,0.6l-0.3,0.5C78.4,2.2,77.9,2,77.4,2c-0.8,0-1.4,0.3-1.8,1c-0.4,0.7-0.6,1.7-0.6,3
			c0,1.3,0.2,2.3,0.6,3s1,1.1,1.8,1.1c0.5,0,1-0.1,1.4-0.2V6.6h-1.3V6z"/>
                        <path class="st1" d="M84,10.6h-3.1v-9H84v0.6h-2.5v3.4h2.4v0.6h-2.4V10H84V10.6z"/>
                    </g>
                </svg>
            </a>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
