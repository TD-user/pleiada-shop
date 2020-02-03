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
