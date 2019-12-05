<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category_id')->dropDownList($categories)->label('Категорія') ?>

<!--    --><?//= $form->field($model, 'code_1c')->textInput()->label('Код 1С') ?>

<!--    --><?//= $form->field($model, 'parent_code_1c')->textInput()->label('') ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Назва товару') ?>

    <?= $form->field($model, 'price')->textInput()->label('Основна ціна') ?>

    <?= $form->field($model, 'promotionPrice')->textInput()->label('Акційна ціна (за наявності)') ?>

    <?= $form->field($model, 'currency')->textInput(['maxlength' => true, 'value' => 'грн'])->label('Валюта') ?>

    <?= $form->field($model, 'remains')->textInput()->label('Залишок товару, кількість') ?>

    <?= $form->field($model, 'unit')->textInput(['maxlength' => true, 'value' => 'шт'])->label('Одиниця виміру') ?>

<!--    --><?//= $form->field($model, 'article')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'manufacturer')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Зберегти', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
