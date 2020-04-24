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
        <?= $form->field($order, 'email')->textInput(['maxlength' => true, 'placeholder' => 'email'])->label(false) ?>
        <?= $form->field($order, 'phone')->textInput(['maxlength' => true, 'placeholder' => 'телефон'])->label(false) ?>
        <?= $form->field($order, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Ім\'я'])->label(false) ?>
        <?= $form->field($order, 'surname')->textInput(['maxlength' => true, 'placeholder' => 'прізвище'])->label(false) ?>
        <div class="text-center" style="margin-bottom: 15px;"><b>Оберіть спосіб доставки</b></div>
        <?= Html::dropDownList('delivery', null, [
            0 => '',
            1 => 'Самовивіз з магазину',
            2 => 'Доставка Новою поштою'
        ], ['class' => 'form-control', 'id' => 'select-method-delivery'])?>

        <div class="nova-poshta-block" style="display: none;">
            <div class="text-center" style="margin-bottom: 15px;"><b>Оберіть місто</b></div>
            <div><?= Select2::widget([
                'name' => 'citiesNp',
                'data' => $cities,
                'options' => [
                    'placeholder' => 'Вибрати місто...',
                    'id' => 'citiesNp'
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) ?></div>
            <div class="text-center" style="margin: 15px 0;"><b>Оберіть відділення</b></div>
            <div>
                <?= Html::dropDownList('warehouse', null, [], ['class' => 'form-control', 'id' => 'select-warehouse-np', 'disabled' => 'disabled'])?>
            </div>
<!--            <div class="text-center" style="margin-bottom: 15px;"><b>Оберіть спосіб оплати</b></div>-->
<!--            --><?//= Html::dropDownList('payment', null, [
//                1 => 'Оплатати зараз картою visa/mastercard',
//                2 => 'Оплата після отримання на відділенні Нової пошти'
//            ], ['class' => 'form-control', 'id' => 'select-method-payment-np'])?>
        </div>
        <div class="self-shop-visit" style="display: none;">
            <div style="margin-bottom: 10px;"><b>Оплата при отриманні товару в магазині за адресою вулиця Івана Мазепи, 33, Трускавець</b></div>
        </div>
        <div class="np-delivery" style="display: none;">
            <div style="margin-bottom: 10px;"><b>Обираючи спосіб доставки "Новою поштою" ви сплачуєте вартість доставки за тарифами перевізника. Оплата за товар здійснюється після його тримання на відділенні</b></div>
        </div>
        <?= Html::activeHiddenInput($order, 'methodDelivery')?>
        <?= Html::activeHiddenInput($order, 'methodPayment')?>
        <?= Html::activeHiddenInput($order, 'address')?>
        <?= Html::activeHiddenInput($order, 'products_json')?>
        <?= Html::activeHiddenInput($order, 'total')?>
        <?= Html::activeHiddenInput($order, 'is_payment')?>
        <?= $form->field($order, 'comment')->textarea(['maxlength' => true, 'rows' => 4, 'placeholder' => 'коментар до замовлення...'])->label(false) ?>
        <input type="submit" value="Замовити">
        <?php ActiveForm::end(); ?>

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
                    <?= Html::activeTextInput($modelOneClickOrder, 'phone', ['pattern' => '\\d*', 'placeholder' => '+38(0__) __ __ ___']) ?>
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
                                    <input type="number" value="<?= $totalCount ?>" max="<?= $product->remains?>">
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
