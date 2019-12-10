<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Admin */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="admin-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group">
        <?php if (strcmp(array_keys(Yii::$app->authManager->getRolesByUser($model->id))[0],'baned') !==0) :?>
                <a href="<?= Url::to(['user/bane', 'id' => $model->id ])?>" class="btn btn-danger">
                    Закрити доступ користувачеві
                </a>
        <?php  else :?>

            <a href="<?= Url::to(['user/unbane', 'id' => $model->id ])?>" class="btn btn-primary">
                Відкрити  доступ користувачеві
            </a>
        <?php  endif;?>
    </div>

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
