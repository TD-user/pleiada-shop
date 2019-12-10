<?php

/* @var $this yii\web\View */
use frontend\widgets;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\jui\DatePicker;

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
                    <h1><?= Html::encode($this->title) ?></h1>

                    <p>Будь ласка, заповніть вказані поля для реєстрації на сайті:</p>
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

                            <div class="form-group">
                                <?= Html::submitButton('Змінити дані', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
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
        <details>
            <summary>
                <div class="order-header-info">
                    <div class="order-small-info">
                        <span class="order-date">24 червня 2019 20:45</span>
                        <span class="order-price">664 грн.</span>
                    </div>
                    <div class="status status-completed">
                        Виконано
                    </div>
                </div>
            </summary>
            <div class="curt-products">
                <div class="curt-product">
                    <img src="/img/penal.png" alt="Пенал" width="100" height="100">
                    <div class="curt-description">
                        <div class="curt-info-title">
                            <a href="#" class="curt-product-name">
                                Пенал з наповненням Herlitz Pretty Pets Horse 19 предметів 1 відділення рожевий (8229270H)
                            </a>
                            <span>Сумма</span>
                        </div>
                        <div class="curt-info-body">
										<span class="curt-price">
											0 000 грн
										</span>
                            <div class="curt-counter">
                                <span class="curn-number-products">2</span>
                            </div>
                            <span class="curt-summary-price">
											0 000 грн
										</span>
                        </div>
                    </div>
                </div>
                <div class="curt-product">
                    <img src="/img/penal.png" alt="Пенал" width="100" height="100">
                    <div class="curt-description">
                        <div class="curt-info-title">
                            <a href="#" class="curt-product-name">
                                Пенал з наповненням Herlitz Pretty Pets Horse 19 предметів 1 відділення рожевий (8229270H)
                            </a>
                            <span>Сумма</span>
                        </div>
                        <div class="curt-info-body">
										<span class="curt-price">
											0 000 грн
										</span>
                            <div class="curt-counter">
                                <span class="curn-number-products">1</span>
                            </div>
                            <span class="curt-summary-price">
											0 000 грн
										</span>
                        </div>
                    </div>
                </div>
            </div>
        </details>
        <details>
            <summary>
                <div class="order-header-info">
                    <div class="order-small-info">
                        <span class="order-date">24 червня 2019 20:45</span>
                        <span class="order-price">664 грн.</span>
                    </div>
                    <div class="status status-cheering">
                        Очікування
                    </div>
                </div>
            </summary>
            <div class="curt-products">
                <div class="curt-product">
                    <img src="/img/penal.png" alt="Пенал" width="100" height="100">
                    <div class="curt-description">
                        <div class="curt-info-title">
                            <a href="#" class="curt-product-name">
                                Пенал з наповненням Herlitz Pretty Pets Horse 19 предметів 1 відділення рожевий (8229270H)
                            </a>
                            <span>Сумма</span>
                        </div>
                        <div class="curt-info-body">
										<span class="curt-price">
											0 000 грн
										</span>
                            <div class="curt-counter">
                                <span class="curn-number-products">1</span>
                            </div>
                            <span class="curt-summary-price">
											0 000 грн
										</span>
                        </div>
                    </div>
                </div>
            </div>
        </details>
        <details>
            <summary>
                <div class="order-header-info">
                    <div class="order-small-info">
                        <span class="order-date">24 червня 2019 20:45</span>
                        <span class="order-price">664 грн.</span>
                    </div>
                    <div class="status status-canceled">
                        Скасовано
                    </div>
                </div>
            </summary>
            <div class="curt-products">
                <div class="curt-product">
                    <img src="/img/penal.png" alt="Пенал" width="100" height="100">
                    <div class="curt-description">
                        <div class="curt-info-title">
                            <a href="#" class="curt-product-name">
                                Пенал з наповненням Herlitz Pretty Pets Horse 19 предметів 1 відділення рожевий (8229270H)
                            </a>
                            <span>Сумма</span>
                        </div>
                        <div class="curt-info-body">
										<span class="curt-price">
											0 000 грн
										</span>
                            <div class="curt-counter">
                                <span class="curn-number-products">1</span>
                            </div>
                            <span class="curt-summary-price">
											0 000 грн
										</span>
                        </div>
                    </div>
                </div>
            </div>
        </details>
    </div>
</div>