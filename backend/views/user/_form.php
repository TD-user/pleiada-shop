<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Admin */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="admin-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'username')->textInput(['maxlength' => true])->label('Логін') ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true])->label('Пошта') ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true])->label('Телефон') ?>

    <?= $form->field($model, 'surname')->textInput(['maxlength' => true])->label('Прізвище') ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Ім\'я') ?>

    <?= $form->field($model, 'fathername')->textInput(['maxlength' => true])->label('Побатькові') ?>

    <?= $form->field($model, 'birthday')->textInput(['maxlength' => true])->label('День народження') ?>

    <?= $form->field($model, 'gender')->textInput(['maxlength' => true])->label('Стать') ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true])->label('Місто') ?>




    <div class="form-group">
        <?= Html::submitButton('Зберегти', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
