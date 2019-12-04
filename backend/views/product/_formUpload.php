<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <!--    --><?//= $form->field($model, 'category_id')->textInput() ?>

    <?= $form->field($model, 'category_id')->dropDownList($categories) ?>

    <?= $form->field($model, 'code_1c')->textInput() ?>

    <?= $form->field($model, 'parent_code_1c')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'promotionPrice')->textInput() ?>

    <?= $form->field($model, 'currency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'remains')->textInput() ?>

    <?= $form->field($model, 'unit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'article')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'manufacturer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelUploadImgs, 'imageFile')->widget(FileInput::classname(), [

        'name' => 'input-ru[]',
        'language' => 'ru',
        'attribute' => 'attachment_1[]',
        'options' => ['multiple' => true ],
        'pluginOptions' => [


            'showPreview' => true,
            'showRemove' => true,
            'showUpload' => true,
            'allowedFileExtensions'=>['jpg','gif','png'],
            'browseClass' => 'btn btn-success',
            'uploadClass' => 'btn btn-info',
            'removeClass' => 'btn btn-danger',
            'removeIcon' => '<i class="glyphicon glyphicon-trash"></i>',

        ],

    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
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
