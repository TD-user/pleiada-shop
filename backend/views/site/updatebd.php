<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 12.12.2019
 * Time: 14:15
 */

use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'path')->fileInput() ?>

    <button>Submit</button>

<?php ActiveForm::end() ?>