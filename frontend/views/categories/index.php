<?php

use yii\helpers\Url;
use frontend\widgets;

$this->title = 'Плеяда - каталог товарів';
?>
<?= widgets\CategoriesAsideWidget::widget()?>
<div class="main-catalog">
    <div class="main-inner-goods no-border">
        <h2>Всі товари</h2>
        <div class="main-all-goods">
            <?php foreach ($categories as $category):?>
                <div class="main-good">
                    <? if($category['img_url'] == ""): ?>
                        <img src="/img/noimage.png" alt="<?= $category['name']?>" title="<?= $category['name']?>">
                    <? else: ?>
                        <img src="<?= $category['img_url']?>" alt="<?= $category['name']?>" title="<?= $category['name']?>">
                    <? endif;?>
                    <span class="main-good-name"><?= $category['name']?></span>
                    <ul class="main-list good-list">
                        <? if(isset($category['childs'])): ?>
                        <?php foreach ($category['childs'] as $subcategory):?>
                            <li><a href="<?= Url::to(['categories/view', 'alias' => $subcategory['alias']])?>"><?= $subcategory['name']?></a></li>
                        <?php endforeach; ?>
                        <? endif;?>
                        <li><a href="<?= Url::to(['categories/view', 'alias' => $category['alias']])?>">Уся продукція</a></li>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
