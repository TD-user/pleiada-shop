<?php

use yii\helpers\Url;
use frontend\widgets;
use common\models\WriteCorrectly;

$this->title = 'Плеяда - каталог товарів';
?>
<?= widgets\CategoriesAsideWidget::widget()?>
<div class="main-catalog">
    <div class="main-inner-goods no-border">
        <h2>Каталог товарів</h2>
        <div class="main-all-goods">
            <?php foreach ($categories as $category):?>
                <div class="main-good">
                    <div class="main-good-head">
                        <? if($category['img_url'] == ""): ?>
                            <img src="/img/noimage.png" alt="<?= $category['name']?>" title="<?= $category['name']?>">
                        <? else: ?>
                            <img src="<?= $category['img_url']?>" alt="<?= $category['name']?>" title="<?= $category['name']?>">
                        <? endif;?>
                        <span class="main-good-name">
                            <a href="<?= Url::to(['categories/view', 'alias' => $category['alias']])?>">
                                <?= WriteCorrectly::mb_ucfirst($category['name'])?>
                            </a>
                        </span>
                    </div>
                    <ul class="main-list good-list">
                        <? if(isset($category['childs'])): ?>
                            <?php foreach ($category['childs'] as $subcategory):?>
                                <li>
                                    <a href="<?= Url::to(['categories/view', 'alias' => $subcategory['alias']])?>"><?= WriteCorrectly::mb_ucfirst($subcategory['name'])?></a>
                                    <? if(isset($subcategory['childs'])): ?>
                                        <ul>
                                            <?php foreach ($subcategory['childs'] as $sub_subcategory):?>
                                                <li><a href="<?= Url::to(['categories/view', 'alias' => $sub_subcategory['alias']])?>" style="padding-left: 10px;"><?= WriteCorrectly::mb_ucfirst($sub_subcategory['name']) ?></a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <? endif;?>
                                </li>
                            <?php endforeach; ?>
                        <? endif; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
