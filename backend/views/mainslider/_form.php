<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Mainslider */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mainslider-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php $arr = \yii\helpers\ArrayHelper::toArray($model); if(empty($arr)): ?>
        <?= $form->field($model, 'path')->hiddenInput(['maxlength' => true, 'value' => '1'])->label('') ?>
    <?php else:?>
        <?= $form->field($model, 'path')->hiddenInput(['maxlength' => true])->label('') ?>
    <?php endif; ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label('Заголовок') ?>

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

    ])->label('Завантажити зображення товару');
    ?>

    <div class="form-group">
        <?= Html::submitButton('Зберегти', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
