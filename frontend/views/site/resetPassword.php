<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Відновлення паролю';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="site-reset-password">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>Будь ласка, оберіть новій пароль:</p>

        <div class="row">
            <div class="col-lg-5">
                <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

                    <?= $form->field($model, 'password')->passwordInput(['autofocus' => true])->label('Пароль') ?>

                    <div class="violet-input-submit-wrapper" style="margin-bottom: 45px;">
                        <?= Html::submitInput('Зберегти') ?>
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
