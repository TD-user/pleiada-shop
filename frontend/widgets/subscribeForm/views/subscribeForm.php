<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>
<div class="subscriber-form-wrapper">
    <?php $formSubscribe = ActiveForm::begin([
        'action' => Url::to(['site/subscribe']),
        'id' => 'subscribe-form',
    ]); ?>
    <?= Html::activeTextInput($subscriber, 'email', ['class' => 'input-adg', 'placeholder' => 'your_email@gmail.com'])?>
    <?= Html::submitButton('Підписатися', ['name' => 'subscribe-button', 'class' => 'button-adg'])?>
    <?php ActiveForm::end(); ?>
</div>
