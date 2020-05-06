<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

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
    <?php endif; ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label("Назва категорії") ?>

    <?= $form->field($model, 'img_url')->hiddenInput(['maxlength' => true])->label("") ?>

    <? if($model->id_parent == 0): ?>
    <div class="hide-if-not-parent">
        <?= $form->field($modelUpload, 'imageFile')->widget(FileInput::classname(), [

            'name' => 'input-ru[]',
            'language' => 'uk',
            'attribute' => 'attachment_1[]',
            //'options' => ['multiple' => true ],
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

        ])->label('Завантажити зображення товару (лише для батьківської категорії)');
        ?>
    </div>
    <? endif;?>

    <div class="form-group">
        <?= Html::submitButton('Зберегти', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php $this->registerJsFile("@web/js/hideIfNotParent.js", [
        'depends' => [
            \yii\web\JqueryAsset::className()
        ]
    ]);?>

</div>
