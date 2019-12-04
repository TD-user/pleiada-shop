<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Reviews */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reviews-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'product_id')->textInput() ?>

<!--    --><?//= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Ім\'я автора' ) ?>

    <?= $form->field($model, 'text')->textarea(['maxlength' => true, 'rows' => '12'])->label('Текст відгуку') ?>

<!--    --><?//= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'is_moderated')->dropDownList([0 => 'Не пройшло модерацію', 1 => 'Прийняти відгук'])->label('відмітка про модерацію відгуку') ?>

<!--    --><?//= $form->field($model, 'moderator_id')->textInput() ?>

<!--    --><?//= $form->field($model, 'moderated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
