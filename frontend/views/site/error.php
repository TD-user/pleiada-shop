<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use frontend\widgets;

$this->title = $name;
?>
<?= widgets\CategoriesAsideWidget::widget()?>
<div class="main-catalog">
    <div class="error">
        <span class="error_title"><?= Html::encode($this->title) ?></span>
        <img src="/img/sad-smile.png" alt="Sorry" width="100" height="100">
        <p>Вибачте, але сторінки, яку ви шукаєте, не існує...</p>
    </div>
</div>
<!--<div class="site-error">-->
<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->
<!---->
<!--    <div class="alert alert-danger">-->
<!--        --><?//= nl2br(Html::encode($message)) ?>
<!--    </div>-->
<!---->
<!--    <p>-->
<!--        The above error occurred while the Web server was processing your request.-->
<!--    </p>-->
<!--    <p>-->
<!--        Please contact us if you think this is a server error. Thank you.-->
<!--    </p>-->
<!--</div>-->
