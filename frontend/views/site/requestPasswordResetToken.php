<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Відновлення паролю';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="site-request-password-reset">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>Будь ласка, вкажіть свій email який було використано при реєстрації. Інструкції по відновленню паролю будуть надіслані на вказану адресу.</p>

        <div class="row">
            <div class="col-lg-5">
                <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                    <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                    <div class="violet-input-submit-wrapper" style="margin-bottom: 45px;">
                        <?= Html::submitInput('Надіслати запит') ?>
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>