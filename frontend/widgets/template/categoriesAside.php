<?php

use yii\helpers\Url;

?>
<?php foreach ($data as $category):?>
<div class="popup-nav">
    <ul>
        <? if(isset($category['childs'])): ?>
        <?php foreach ($category['childs'] as $subcategory):?>
        <li><a href="<?= Url::to(['categories/view', 'alias' => $subcategory['alias']])?>" class="pretty-nav-title" style="margin-bottom: 5px;"><?= $subcategory['name']?></a></li>
            <? if(isset($subcategory['childs'])): ?>
                <?php foreach ($subcategory['childs'] as $sub_subcategory):?>
                    <li><a href="<?= Url::to(['categories/view', 'alias' => $sub_subcategory['alias']])?>" style="padding-left: 10px;"><?= $sub_subcategory['name']?></a></li>
                <?php endforeach; ?>
            <? endif;?>
        <?php endforeach; ?>
        <? endif;?>
    </ul>
</div>
<? endforeach; ?>
<div class="popup-nav">
</div>
<div class="main-menu">
    <ul class="main-list nav-list">
        <?php foreach ($data as $category):?>
        <li>
            <a href="<?= Url::to(['categories/view', 'alias' => $category['alias']])?>"><?= $category['name']?></a>
        </li>
        <? endforeach; ?>
        <li>
            <a href="<?= Url::to(['categories/index'])?>" class="no-arrow">Усі категорії</a>
        </li>
    </ul>
<!--    <div class="menu-price-filter">-->
<!--        <div class="menu-prices">-->
<!--            <form action="" method="">-->
<!--                <input type="number" value="10">-->
<!--                <span class="menu-help-labels">-</span>-->
<!--                <input type="number" value="2400">-->
<!--                <span class="menu-help-labels">грн</span>-->
<!--                <button>ОК</button>-->
<!--                <div class="menu-slider">-->
<!--                    <input id="price-slider" type="text"/>-->
<!--                </div>-->
<!--            </form>-->
<!--        </div>-->
<!--    </div>-->
</div>