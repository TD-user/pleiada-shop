<?php

use yii\helpers\Url;
use frontend\widgets;
use yii\widgets\LinkPager;
use common\models\WriteCorrectly;

$this->title = 'Плеяда - результати пошуку';
?>
<?= widgets\CategoriesAsideWidget::widget()?>
<div class="main-catalog">
    <? if (isset($products)): ?>
    <h2 class="inner-title">Результат пошуку: "<?= $search ?>". Знайдено <?= $count.' '.WriteCorrectly::corecllyResults($count)  ?></h2>
    <div class="main-outer-goods" style="padding-bottom: 30px">
        <? foreach ($products as $product): ?>
            <div class="main-outer-good">
                <div class="img-wrapper">
                    <? if($product->getImages()->count() == 0): ?>
                        <img src="/img/noimage.png" alt="" title="">
                    <? elseif ($product->getImages()->count() == 1):?>
                        <img src="<?= $product->getImages()->all()[0]->path; ?>" alt="<?= $product->getImages()->all()[0]->title; ?>" title="<?= $product->getImages()->all()[0]->title; ?>">
                    <? else: ?>
                        <div class="swap-good">
                            <img class="first-good-img" src="<?= $product->getImages()->all()[0]->path; ?>" alt="<?= $product->getImages()->all()[0]->title; ?>" title="<?= $product->getImages()->all()[0]->title; ?>">
                            <img class="second-good-img" src="<?= $product->getImages()->all()[1]->path; ?>" alt="<?= $product->getImages()->all()[1]->title; ?>" title="<?= $product->getImages()->all()[1]->title; ?>">
                        </div>
                    <? endif; ?>
                </div>
                <a href="<?= Url::to(['product/view', 'alias' => $product->alias, 'id' => $product->id])?>" class="outer-good-title">
                    <?= $product->name; ?>
                </a>
                <? if($product->promotionPrice != 0 and $product->promotionPrice != null): ?>
                    <strike><span class="discount-price"><?= $product->price." ".$product->currency; ?></span></strike>
                <? endif; ?>
                <div class="current-price">
                    <? if($product->promotionPrice != 0 and $product->promotionPrice != null): ?>
                        <span class="price discount"><?= $product->promotionPrice." ".$product->currency; ?></span>
                    <? else: ?>
                        <span class="price"><?= $product->price." ".$product->currency; ?></span>
                    <? endif; ?>
                    <div class="reviews">
                        <span class="reviews-count">
                            <?php
                            echo $product->getReviews()->where(['is_moderated' => 1])->count();
                            echo ' ';
                            echo WriteCorrectly::corecllyReviews($product->getReviews()->where(['is_moderated' => 1])->count());
                            ?>
                        </span>
                    </div>
                </div>
                <div class="outer-good-buy">
                    <a href="#" data-id="<?= $product->id ?>" class="add-to-cart good-buy <? if($product->remains<=0) echo 'good-buy-disabled'?>">Купити</a>
                    <div class="outer-good-icons <? if($product->isProductFavouriteToUser(Yii::$app->user->identity->id)) echo 'selected'; ?>">
                        <a data-id="<?= $product->id ?>" class="add-to-favourite" href="#"></a>
                    </div>
                </div>
            </div>
        <? endforeach; ?>
    </div>
    <div class="row">
        <div class="col-sm-12 center">
            <?= LinkPager::widget(['pagination' => $pagination]); ?>
        </div>
    </div>
    <? else: ?>
        <h2 class="inner-title">Нажаль за ващим запитом нічого не знайдено</h2>
    <? endif; ?>
</div>