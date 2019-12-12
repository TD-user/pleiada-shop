<?php

/* @var $this yii\web\View */
use frontend\widgets;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\jui\DatePicker;
use yii\widgets\LinkPager;
use yii\helpers\Url;

$this->title = 'Плеяда - особистий кабінет';
?>
<?= widgets\CategoriesAsideWidget::widget()?>
<div class="main-catalog">
    <div class="change-personal-info">
        <details>
            <summary>
                <div class="header-change-info">
                    Зміна особистих даних
                </div>
            </summary>
            <div class="change-form">
                <div class="container">
                    <small>* - обов'язкові поля</small>
                    <br><br>
                    <div class="row">
                        <div class="col-sm-12">
                            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                            <?= $form->field($model, 'email')->textInput()->label('Логін (email) *') ?>

                            <?= $form->field($model, 'phone')->textInput()->label('Телефон *') ?>

                            <?= $form->field($model, 'surname')->textInput()->label('Прізвище *') ?>

                            <?= $form->field($model, 'name')->textInput()->label('Ім\'я *') ?>

                            <?= $form->field($model, 'fathername')->textInput()->label('По батькові') ?>

                            <?= $form->field($model, 'birthday')->widget(DatePicker::className(), [
                                'options' => ['class' => 'form-control'],
                                'language' => 'uk-UA',
                                'dateFormat' => 'dd.MM.yyyy',
                                'clientOptions' => [
                                    'changeMonth'=> true,
                                    'changeYear'=> true,
                                    'yearRange' => '1900:2030'
                                ]
                            ])->textInput(['placeholder' => 'дд.мм.рррр'])->label('Дата народження') ?>

                            <?= $form->field($model, 'gender', [
                                'radioTemplate' => '<label class="gender-head">{label}</label><label class="signup-radio">{input}</label>'
                            ])->inline()->radioList([1 => 'чоловіча', 2 => 'жіноча'])->label('Стать')?>

                            <?= $form->field($model, 'city')->textInput()->label('Місто') ?>

                            <?= $form->field($model, 'password')->passwordInput()->label('Пароль *') ?>

                            <?= $form->field($model, 'confirm')->passwordInput()->label('Підтвердіть пароль *') ?>

                            <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                                'template' => '<div class="row"><div class="col-sm-3">{image}</div><div class="col-sm-6">{input}</div></div>',
                            ])->label('Код підтвердження *') ?>

                            <div class="violet-input-submit-wrapper" style="margin-bottom: 45px;">
                                <?= Html::submitInput('Змінити дані', ['name' => 'signup-button']) ?>
                            </div>

                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </details>
    </div>
    <h2 class="title-h2 title-retreat">Історія замовлень</h2>
    <div class="order-history">
        <? foreach ($orders as $order): ?>
            <details>
                <summary>
                    <div class="order-header-info">
                        <div class="order-small-info">
                            <span class="order-date"><?= date('d.m.Y H:i:s', $order->created_at); ?></span>
                            <span class="order-price"><?= number_format($order->total, 2); ?> грн.</span>
                        </div>
                        <div class="status"><?= $order->status; ?></div>
                    </div>
                </summary>
                <div class="curt-products">
                <? foreach (json_decode($order->products_json) as $product): ?>
                <?php $product_origin = \common\models\Product::findOne($product->product_id); ?>
                <? if($product_origin !== null): ?>
                    <div class="curt-product">
                        <div class="curt-good-img">
                            <? if($product_origin->getImages()->count() == 0): ?>
                                <img src="/img/noimage.png" alt="no image">
                            <? else:?>
                                <img src="<?= $product_origin->getImages()->all()[0]->path; ?>" alt="<?= $product_origin->getImages()->all()[0]->title; ?>" title="<?= $product_origin->getImages()->all()[0]->title; ?>">
                            <? endif; ?>
                        </div>
                        <div class="curt-description">
                            <div class="curt-info-title">
                                <a href="<?= Url::to(['product/view', 'alias' => $product_origin->alias, 'id' => $product_origin->id])?>" class="curt-product-name">
                                    <?= $product->name; ?>
                                </a>
                                <span>Сума</span>
                            </div>
                            <div class="curt-info-body">
                                <span class="curt-price">
                                    <?= number_format($product->price, 2); ?> грн
                                </span>
                                <div class="curt-counter">
                                    <span class="curn-number-products"><?= $product->count?></span>
                                </div>
                                <span class="curt-summary-price">
                                    <?= number_format($product->summa, 2); ?> грн
                                </span>
                            </div>
                        </div>
                    </div>
                <? endif;?>
                <? endforeach;?>
                </div>
            </details>
        <? endforeach; ?>

        <div class="row">
            <div class="col-sm-12 center">
                <?= LinkPager::widget(['pagination' => $pagination]); ?>
            </div>
        </div>
    </div>
</div>