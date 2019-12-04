<?php

/* @var $this yii\web\View */
use frontend\widgets;

$this->title = 'Плеяда - умови використання сайту';
?>
<?= widgets\CategoriesAsideWidget::widget()?>
<div class="main-catalog">
    <div class="main-info-blc">
        <div class="text-blc">
            <?= $page->text ?>
        </div>
    </div>
</div>