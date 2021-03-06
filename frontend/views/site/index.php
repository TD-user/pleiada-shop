<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\helpers\Html;
use frontend\widgets;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use common\models\WriteCorrectly;
use yii\widgets\Pjax;

$this->title = 'Плеяда';
?>
<?= widgets\CategoriesAsideWidget::widget()?>
<div class="main-catalog">
    <div class="main-inner-goods">
        <div class="main-carousel">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <?php
                    for ($i = 0; $i < $mainSliderCount; $i++) {
                        if($i == 0)
                            echo '<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>';
                        else
                            echo '<li data-target="#carouselExampleIndicators" data-slide-to="'.$i.'"></li>';
                    }
                    ?>
                </ol>
                <div class="carousel-inner">
                    <?php $sliderFlag = true; ?>
                    <? foreach ($mainSlider as $slide):?>
                        <div class="carousel-item <?php if($sliderFlag) {$sliderFlag = false; echo 'active';}?>">
                            <div class="carousel-item__inner">
                                <img src="<?= $slide->path ?>" class="d-block w-100" alt="<?= $slide->title ?>" title="<?= $slide->title ?>">
                            </div>
                        </div>
                    <? endforeach; ?>
                </div>
            </div>
        </div>
        <h2>Категорії</h2>
        <div class="main-all-goods index">
            <?php foreach ($categories as $category):?>
                <div class="main-good index">
                    <div class="main-good-head">
                        <? if($category['img_url'] == ""): ?>
                            <img src="/img/noimage.png" alt="<?= $category['name']?>" title="<?= $category['name']?>">
                        <? else: ?>
                            <img src="<?= $category['img_url']?>" alt="<?= $category['name']?>" title="<?= WriteCorrectly::mb_ucfirst($category['name'])?>">
                        <? endif;?>
                        <span class="main-good-name">
                            <a href="<?= Url::to(['categories/view', 'alias' => $category['alias']])?>">
                                <?= WriteCorrectly::mb_ucfirst($category['name']) ?>
                            </a>
                        </span>
                    </div>
<!--                    <ul class="main-list good-list">-->
<!--                        --><?// if(isset($category['childs'])): ?>
<!--                        --><?php //foreach ($category['childs'] as $subcategory):?>
<!--                            <li>-->
<!--                                <a href="--><?//= Url::to(['categories/view', 'alias' => $subcategory['alias']])?><!--">--><?//= WriteCorrectly::mb_ucfirst($subcategory['name'])?><!--</a>-->
<!--                                --><?// if(isset($subcategory['childs'])): ?>
<!--                                    <ul>-->
<!--                                    --><?php //foreach ($subcategory['childs'] as $sub_subcategory):?>
<!--                                        <li><a href="--><?//= Url::to(['categories/view', 'alias' => $sub_subcategory['alias']])?><!--" style="padding-left: 10px;">--><?//= WriteCorrectly::mb_ucfirst($sub_subcategory['name']) ?><!--</a></li>-->
<!--                                    --><?php //endforeach; ?>
<!--                                    </ul>-->
<!--                                --><?// endif;?>
<!--                            </li>-->
<!--                        --><?php //endforeach; ?>
<!--                        --><?// endif; ?>
<!--                        <li><a href="--><?//= Url::to(['categories/view', 'alias' => $category['alias']])?><!--">Уся продукція</a></li>-->
<!--                    </ul>-->
                </div>
            <?php endforeach; ?>


<!--            --><?php //foreach ($categories as $category):?>
<!--                <div class="main-good">-->
<!--                    <div class="main-good-head">-->
<!--                        --><?// if($category['img_url'] == ""): ?>
<!--                            <img src="/img/noimage.png" alt="--><?//= $category['name']?><!--" title="--><?//= $category['name']?><!--">-->
<!--                        --><?// else: ?>
<!--                            <img src="--><?//= $category['img_url']?><!--" alt="--><?//= $category['name']?><!--" title="--><?//= WriteCorrectly::mb_ucfirst($category['name'])?><!--">-->
<!--                        --><?// endif;?>
<!--                        <span class="main-good-name">--><?//= WriteCorrectly::mb_ucfirst($category['name']) ?><!--</span>-->
<!--                    </div>-->
<!--                    <ul class="main-list good-list">-->
<!--                        --><?// if(isset($category['childs'])): ?>
<!--                            --><?php //foreach ($category['childs'] as $subcategory):?>
<!--                                <li>-->
<!--                                    <a href="--><?//= Url::to(['categories/view', 'alias' => $subcategory['alias']])?><!--">--><?//= WriteCorrectly::mb_ucfirst($subcategory['name'])?><!--</a>-->
<!--                                    --><?// if(isset($subcategory['childs'])): ?>
<!--                                        <ul>-->
<!--                                            --><?php //foreach ($subcategory['childs'] as $sub_subcategory):?>
<!--                                                <li><a href="--><?//= Url::to(['categories/view', 'alias' => $sub_subcategory['alias']])?><!--" style="padding-left: 10px;">--><?//= WriteCorrectly::mb_ucfirst($sub_subcategory['name']) ?><!--</a></li>-->
<!--                                            --><?php //endforeach; ?>
<!--                                        </ul>-->
<!--                                    --><?// endif;?>
<!--                                </li>-->
<!--                            --><?php //endforeach; ?>
<!--                        --><?// endif; ?>
<!--                        <li><a href="--><?//= Url::to(['categories/view', 'alias' => $category['alias']])?><!--">Уся продукція</a></li>-->
<!--                    </ul>-->
<!--                </div>-->
<!--            --><?php //endforeach; ?>
        </div>


<!--        <div class="main-all-goods">-->
<!--            --><?php //foreach ($categories as $category):?>
<!--                <div class="main-good">-->
<!--                    --><?// if($category['img_url'] == ""): ?>
<!--                        <img src="/img/noimage.png" alt="--><?//= $category['name']?><!--" title="--><?//= $category['name']?><!--">-->
<!--                    --><?// else: ?>
<!--                        <img src="--><?//= $category['img_url']?><!--" alt="--><?//= $category['name']?><!--" title="--><?//= $category['name']?><!--">-->
<!--                    --><?// endif;?>
<!--                    <span class="main-good-name">--><?//= $category['name']?><!--</span>-->
<!--                    <ul class="main-list good-list">-->
<!--                        --><?// if(isset($category['childs'])): ?>
<!--                        --><?php //foreach ($category['childs'] as $subcategory):?>
<!--                            <li><a href="--><?//= Url::to(['categories/view', 'alias' => $subcategory['alias']])?><!--">--><?//= $subcategory['name']?><!--</a></li>-->
<!--                        --><?php //endforeach; ?>
<!--                        --><?// endif; ?>
<!--                        <li><a href="--><?//= Url::to(['categories/view', 'alias' => $category['alias']])?><!--">Уся продукція</a></li>-->
<!--                    </ul>-->
<!--                </div>-->
<!--            --><?php //endforeach; ?>
<!--        </div>-->
    </div>


    <? if ($promotionProducts !== null and !empty($promotionProducts)):?>
        <h2 class="inner-title">Акційні товари</h2>
        <div class="main-outer-goods">
            <? foreach ($promotionProducts as $product): ?>
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
                        <strike><span class="discount-price"><?= number_format($product->price, 2)." ".$product->currency; ?></span></strike>
                    <? endif; ?>
                    <div class="current-price">
                        <? if($product->promotionPrice != 0 and $product->promotionPrice != null): ?>
                            <span class="price discount"><?= number_format($product->promotionPrice, 2)." ".$product->currency; ?></span>
                        <? else: ?>
                            <span class="price"><?= number_format($product->price, 2)." ".$product->currency; ?></span>
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
        <div>
            <a href="<?= Url::to(['site/all-promotion-products'])?>" class="main-page-block-href">Всі акційні товари</a>
        </div>
    <? endif; ?>


    <? if ($popularProducts !== null and !empty($popularProducts)):?>
        <h2 class="inner-title">Популярні товари</h2>
        <div class="main-outer-goods">
            <? foreach ($popularProducts as $product): ?>
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
                        <strike><span class="discount-price"><?= number_format($product->price, 2)." ".$product->currency; ?></span></strike>
                    <? endif; ?>
                    <div class="current-price">
                        <? if($product->promotionPrice != 0 and $product->promotionPrice != null): ?>
                            <span class="price discount"><?= number_format($product->promotionPrice, 2)." ".$product->currency; ?></span>
                        <? else: ?>
                            <span class="price"><?= number_format($product->price, 2)." ".$product->currency; ?></span>
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
        <div>
            <a href="<?= Url::to(['site/all-popular-products'])?>" class="main-page-block-href">Всі популярні товари</a>
        </div>
    <? endif; ?>


    <? if ($watchedProducts !== null and !empty($watchedProducts)):?>
        <h2 class="inner-title">Останні переглянуті товари</h2>
        <div class="main-outer-goods">
            <? foreach ($watchedProducts as $product): ?>
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
                        <strike><span class="discount-price"><?= number_format($product->price, 2)." ".$product->currency; ?></span></strike>
                    <? endif; ?>
                    <div class="current-price">
                        <? if($product->promotionPrice != 0 and $product->promotionPrice != null): ?>
                            <span class="price discount"><?= number_format($product->promotionPrice, 2)." ".$product->currency; ?></span>
                        <? else: ?>
                            <span class="price"><?= number_format($product->price, 2)." ".$product->currency; ?></span>
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
        <div>
            <a href="<?= Url::to(['user/all-watched-products'])?>" class="main-page-block-href">Всі переглянуті товари</a>
        </div>
    <? endif; ?>

</div>
