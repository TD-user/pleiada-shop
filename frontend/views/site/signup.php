<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\jui\DatePicker;

$this->title = 'Реєстрація';
?>
<div class="container"> 
    <div class="site-signup">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>Будь ласка, заповніть вказані поля для реєстрації на сайті:</p>
        <small>* - обов'язкові поля</small>
        <br><br>
        <div class="row">
            <div class="col-sm-5">
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
                        <?= Html::submitInput('Зареєструватися', ['name' => 'signup-button']) ?>
                    </div>

                    <div style="margin-bottom: 45px;"></div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
