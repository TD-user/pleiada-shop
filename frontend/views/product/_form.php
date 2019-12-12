<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Reviews */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reviews-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($modelReview, 'product_id')->hiddenInput()->label(false) ?>

    <?= $form->field($modelReview, 'user_id')->hiddenInput()->label(false) ?>

    <?= $form->field($modelReview, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Введіть ім\'я'])->label(false) ?>

    <?= $form->field($modelReview, 'text')->textarea(['maxlength' => true, 'rows' => '12', 'placeholder' => 'Коментар...'])->label(false) ?>

    <div class="violet-input-submit-wrapper text-center">
        <input type="submit" value="Відправити">
    </div>

    <?php ActiveForm::end(); ?>

</div>
