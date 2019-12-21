<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total')->textInput() ?>

    <?= $form->field($model, 'products_json')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([
        'Нове' => 'Нове',
        'В роботі' => 'В роботі',
        'Відправлено' => 'Відправлено',
        'Завершено' => 'Завершено',
    ]) ?>

    <?= $form->field($model, 'is_payment')->textInput() ?>

    <?= $form->field($model, 'comment')->textarea(['maxlength' => true, 'rows' => 5]) ?>

    <?= $form->field($model, 'comment_admin')->textarea(['maxlength' => true, 'rows' => 5]) ?>

    <?= $form->field($model, 'methodPayment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'methodDelivery')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'cost')->textInput() ?>

<!--    --><?//= $form->field($model, 'payment')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Зберегти', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
