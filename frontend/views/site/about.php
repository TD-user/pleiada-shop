<?php

/* @var $this yii\web\View */
use frontend\widgets;

$this->title = 'Плеяда - про нас';
?>
<?= widgets\CategoriesAsideWidget::widget()?>
<div class="main-catalog">
    <div class="main-info-blc">
        <div class="text-blc">
            <?= $page->text ?>
        </div>
    </div>
</div>