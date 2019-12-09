<?php

/* @var $this yii\web\View */
use frontend\widgets;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\select2\Select2;

$this->title = 'Плеяда - корзина';
?>
<div class="order-container">
    <div class="order-info">
        <?php $form = ActiveForm::begin([
            'action' => '/user/order',
            'id' => 'mainFormOrder',
            'options' => [
                'class' => 'order-form'
            ]
        ]); ?>
        <?= Select2::widget([
            'name' => 'state_10',
            'data' => $cities,
            'options' => [
                'placeholder' => 'вибрати місто ...',
            ],
        ]);?>
        <input type="submit" value="Замовити">
        <?php ActiveForm::end(); ?>
<!--        <form action="" method="post" class="order-form">-->
<!--            <input type="text" name="pib" placeholder="Прізвище Ім'я По батькові...">-->
<!--            <input type="tel" name="phone" placeholder="+38(0__) __ __ ___">-->
<!--            <input type="text" name="email" placeholder="Email...">-->
<!--            <select name="city">-->
<!--                <option>Виберіть місто...</option>-->
<!--                <option value="Луцьк">Луцьк</option>-->
<!--                <option value="Львів">Львів</option>-->
<!--                <option value="Київ">Київ</option>-->
<!--            </select>-->
<!--            <textarea name="comment" cols="30" rows="5" placeholder="Ваш коментар до замовлення..."></textarea>-->
<!--            <input type="submit" value="Замовити">-->
<!--        </form>-->
        <div class="order-goods">
            <div class="one-click">
                <div>
                    <p>Бажаєтее оформити замовлення в один клік?</p>
                    <p>Залиште свій номер телефону, по якому наш менеджер зв'яжеться з Вами для оформлення покупки</p>
                </div>
                <div class="click-separator"></div>
                <div>
                    <?php $form = ActiveForm::begin([
                        'action' => '/user/one-click-order',
                        'id' => 'oneClickOrder',
                        'options' => [
                            'class' => 'one-clock-form'
                        ]
                    ]); ?>
                    <?= Html::activeHiddenInput($modelOneClickOrder, 'products_json')?>
                    <?= Html::activeHiddenInput($modelOneClickOrder, 'total')?>
                    <?= Html::activeTextInput($modelOneClickOrder, 'phone', ['pattern' => '\\d*']) ?>
                    <input type="submit" value="OK">
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
            <div class="curt-products order-products">
                <?php $totalValue = 0; ?>
                <? foreach ($products as $product): ?>
                <?php $totalCount = $product->getCarts()->where(['user_id' => Yii::$app->user->identity->id])->one()->count; ?>
                <div class="curt-product" data-id="<?= $product->id ?>">
                    <div class="curt-close del-from-cart" data-id="<?= $product->id ?>">✖</div>
                    <div class="curt-good-img">
                        <? if($product->getImages()->count() == 0): ?>
                            <img src="/img/noimage.png" alt="no image">
                        <? else:?>
                            <img src="<?= $product->getImages()->all()[0]->path; ?>" alt="<?= $product->getImages()->all()[0]->title; ?>" title="<?= $product->getImages()->all()[0]->title; ?>">
                        <? endif; ?>
                    </div>
                    <div class="curt-description">
                        <div class="curt-info-title">
                            <a href="<?= Url::to(['product/view', 'alias' => $product->alias, 'id' => $product->id])?>" class="curt-product-name">
                                <?= $product->name; ?>
                            </a>
                            <span>Сума</span>
                        </div>
                        <div class="curt-info-body">
                            <span class="curt-price">
                                <span class="price-value">
                                <? if($product->promotionPrice != 0 and $product->promotionPrice != null): ?>
                                    <?= number_format($product->promotionPrice, 2) ?>
                                <?else:?>
                                    <?= number_format($product->price, 2) ?>
                                <?endif;?>
                                </span>
                                <span>
                                    <?= " ".$product->currency; ?>
                                </span>
                            </span>
                            <div class="curt-counter">
                                <span class="curn-symbols curt-minus">-</span>
                                <span class="curn-number-products">
                                    <?= $totalCount ?>
                                </span>
                                <span class="curn-symbols curt-plus" maxcount="<?= $product->remains?>">+</span>
                            </div>
                            <span class="curt-summary-price">
                                <span class="total-value">
                                <? if($product->promotionPrice != 0 and $product->promotionPrice != null): ?>
                                    <?php $totalValue+=$product->promotionPrice*$totalCount; echo number_format($product->promotionPrice*$totalCount, 2); ?>
                                <?else:?>
                                    <?php $totalValue+=$product->price*$totalCount; echo number_format($product->price*$totalCount, 2); ?>
                                <?endif;?>
                                </span>
                                <span>
                                    <?= " ".$product->currency; ?>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <? endforeach; ?>

                <div class="curt-total">
                    <div class="curt-total-info">
                        <span>Всього:</span>
                        <span>
                            <span id="full-cart-value">
                                <?= number_format($totalValue, 2) ?>
                            </span>
                            грн
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
