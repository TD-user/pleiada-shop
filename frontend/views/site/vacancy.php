<?php

/* @var $this yii\web\View */

use frontend\widgets;

$this->title = 'Плеяда - вакансії';
?>
<?= widgets\CategoriesAsideWidget::widget()?>
<div class="main-catalog">
    <div class="main-info-blc">
        <div class="text-blc">
            <?= $page->text ?>
        </div>
    </div>
</div>