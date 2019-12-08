<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $arr = \yii\helpers\ArrayHelper::toArray($model); ?>

    <?php $form = ActiveForm::begin(); ?>

    <!--    --><?//= $form->field($model, 'category_id')->textInput() ?>

    <?= $form->field($model, 'category_id')->dropDownList($categories)->label('Категорія') ?>

<!--    --><?//= $form->field($model, 'code_1c')->textInput()->label('Код 1С') ?>

<!--    --><?//= $form->field($model, 'parent_code_1c')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Назва товару') ?>

    <?= $form->field($model, 'price')->textInput()->label('Основна ціна') ?>

    <?= $form->field($model, 'promotionPrice')->textInput()->label('Акційна ціна (за наявності)') ?>

    <? if(empty($arr)): ?>
        <?= $form->field($model, 'currency')->textInput(['maxlength' => true, 'value' => 'грн'])->label('Валюта') ?>
    <? else: ?>
        <?= $form->field($model, 'currency')->textInput(['maxlength' => true])->label('Валюта') ?>
    <? endif; ?>

    <?= $form->field($model, 'remains')->textInput()->label('Залишок товару, кількість') ?>

    <? if(empty($arr)): ?>
        <?= $form->field($model, 'unit')->textInput(['maxlength' => true, 'value' => 'шт'])->label('Одиниця виміру') ?>
    <? else: ?>
        <?= $form->field($model, 'unit')->textInput(['maxlength' => true])->label('Одиниця виміру') ?>
    <? endif; ?>

<!--    --><?//= $form->field($model, 'article')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'manufacturer')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelUploadImgs, 'imageFile')->widget(FileInput::classname(), [

        'name' => 'input-ru[]',
        'language' => 'ru',
        'attribute' => 'attachment_1[]',
        'options' => ['multiple' => true ],
        'pluginOptions' => [


            'showPreview' => true,
            'showRemove' => true,
            'showUpload' => true,
            'allowedFileExtensions'=>['jpg','jpeg','gif','png'],
            'browseClass' => 'btn btn-success',
            'uploadClass' => 'btn btn-info',
            'removeClass' => 'btn btn-danger',
            'removeIcon' => '<i class="glyphicon glyphicon-trash"></i>',

        ],

    ])->label('Завантажити зображення товару');
    ?>

    <div class="form-group">
        <?= Html::submitButton('Зберегти', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<!---->
<!--    --><?php //$formUpload = ActiveForm::begin(); ?>
<!---->
<!--    --><?//= $formUpload->field($modelUploadImgs, 'imageFile')->widget(FileInput::classname(), [
//
//        'name' => 'input-ru[]',
//        'language' => 'ru',
//        'attribute' => 'attachment_1[]',
//        'options' => ['multiple' => true ],
//        'pluginOptions' => [
//
//
//            'showPreview' => true,
//            'showRemove' => true,
//            'showUpload' => true,
//            'allowedFileExtensions'=>['jpg','gif','png'],
//            'browseClass' => 'btn btn-success',
//            'uploadClass' => 'btn btn-info',
//            'removeClass' => 'btn btn-danger',
//            'removeIcon' => '<i class="glyphicon glyphicon-trash"></i>',
//
//        ],
//
//    ]);
//    ?>
<!---->
<!--    --><?php //ActiveForm::end(); ?>

</div>
