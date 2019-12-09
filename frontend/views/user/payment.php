<?php

/* @var $this yii\web\View */
use frontend\widgets;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\select2\Select2;

$this->title = 'Плеяда - оплата';
?>
<div class="order-container">
    <?=\borysenko\liqpay\widgets\PaymentForm::widget([
        'autoSend' => true,
        'orderModel' => $model, //Order::findOne($id);
        'description' => 'Оплата заказа'
    ]);?>

</div>
