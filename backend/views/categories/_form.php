<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Categories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categories-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php $arr = \yii\helpers\ArrayHelper::toArray($model); if(empty($arr)): ?>
        <?= $form->field($model, 'id_parent')->dropDownList($parent_categories, ['options' => [0 => ['selected' => true]]])->label("Батьківська категорія") ?>
    <?php else:?>
        <?= $form->field($model, 'id_parent')->dropDownList($parent_categories)->label("Батьківська категорія") ?>
    <?php endif ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label("Назва категорії") ?>

    <?= $form->field($model, 'img_url')->textInput(['maxlength' => true])->label("Зображення") ?>

    <div class="form-group">
        <?= Html::submitButton('Зберегти', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
