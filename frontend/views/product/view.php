<?php

use yii\helpers\Url;
use frontend\widgets;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Плеяда - '.$model->name;
?>
<?= widgets\CategoriesAsideWidget::widget()?>
<div class="main-catalog">
    <div class="product">
        <span class="title-h2"><?= $model->name; ?></span>
        <span class="code">Код товара: <strong><?= $model->code_1c; ?></strong></span>
        <div class="container">
            <div class="row good-main-info">
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <? if($model->getImages()->count() == 0): ?>
                        <img src="/img/noimage.png" alt="" title="" height="200" width="200">
                    <? elseif ($model->getImages()->count() == 1):?>
                        <img src="<?= $model->getImages()->all()[0]->path; ?>" alt="<?= $model->getImages()->all()[0]->title; ?>" title="<?= $model->getImages()->all()[0]->title; ?>" height="200" width="200">
                    <? else: ?>
                        <div id="carousel-first-tab" class="carousel slide product-slider" data-ride="carousel">
                            <div class="carousel-inner" role="listbox">
                                <? $flag = true; ?>
                                <? foreach ($model->getImages()->all() as $image):?>
                                <div class="item <?php if($flag) {echo 'active'; $flag = false; }?>">
                                    <img src="<?= $image->path; ?>" alt="<?= $image->title; ?>">
                                </div>
                                <? endforeach; ?>
                            </div>
                            <a class="left carousel-control" href="#carousel-first-tab" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#carousel-first-tab" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                    <? endif; ?>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-6">
                                    <span class="prod-pr">ціна:</span><br>
                                    <? if($model->promotionPrice != 0 and $model->promotionPrice != null): ?>
                                        <span class="prod-mn <? if($model->remains<=0) echo 'not-available'?> promo-price"><?= $model->promotionPrice." ".$model->currency; ?></span>
                                        <span class="prod-mn "><?= $model->price." ".$model->currency; ?></span>
                                    <? else: ?>
                                        <span class="prod-mn <? if($model->remains<=0) echo 'not-available'?>"><?= $model->price." ".$model->currency; ?></span>
                                    <? endif; ?>
                                </div>
                                <div class="col-xs-6 btns-product">
                                    <div class="small-btn-good">
                                        <button class="btn btn-default btn-lg img-center btn-40px <? if($model->remains<=0) echo 'not-available'?>"><span class="glyphicon glyphicon-shopping-cart"></span></button>
                                        <button class="btn btn-default btn-lg img-center btn-40px"><span class="glyphicon glyphicon-heart"></span></button>
                                    </div>
                                    <button class="btn btn-danger btn-lg img-center btn-100px <? if($model->remains<=0) echo 'not-available'?>">Купити</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-tabs">
            <div class="container">
                <div class="row">
                    <h3>Відгуки: </h3>
                </div>
                <div class="row">
                    <? if ($model->getReviews()->where(['is_moderated' => 1])->count() == 0):?>
                    <p>Про цей товар поки немає відгуків. Станьте першим</p>
                    <? endif;?>
                    <? foreach ($model->getReviews()->where(['is_moderated' => 1])->all() as $review): ?>
                    <div class="panel panel-danger panel-violet">
                        <div class="panel-heading">
                            <?= $review->name; ?>
                        </div>
                        <div class="panel-body">
                            <p><?= $review->text; ?></p>
                        </div>
                    </div>
                    <? endforeach; ?>
                </div>
            </div>
            <div class="product-feedback">
                <h3 class="center">Залишити відгук</h3>
                <?php
                    $modelReview->product_id = $model->id;
                    $modelReview->user_id = Yii::$app->user->identity->id;
                    $modelReview->name = Yii::$app->user->identity->name;

                ?>
                <?= $this->render('_form', [
                    'modelReview' => $modelReview,
                ]) ?>

            </div>
        </div>
    </div>
</div>
