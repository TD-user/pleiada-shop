<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Social */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="social-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'path')->textInput(['maxlength' => true])->label('Шлях') ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])-> label('Назва') ?>

    <?= $form->field($model, 'href')->textInput(['maxlength' => true])-> label('Посилання') ?>

    <div class="form-group">
        <?= Html::submitButton('Збернгти', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
