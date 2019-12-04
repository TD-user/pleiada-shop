<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Вхід';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container"> 
    <div class="site-login">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>Будь ласка, заповніть вказані поля для входу:</p>

        <div class="row">
            <div class="col-lg-5">
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                    <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Логін (email)') ?>

                    <?= $form->field($model, 'password')->passwordInput()->label('Пароль') ?>

                    <?= $form->field($model, 'rememberMe')->checkbox()->label('Запам\'ятати мене') ?>

                    <div style="color:#999;margin:1em 0">
                        Якщо ви забули пароль, ви можете <?= Html::a('відновити його', ['site/request-password-reset']) ?>.
                    </div>

                    <div class="form-group">
                        <?= Html::submitButton('Увійти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>