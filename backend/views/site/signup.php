<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 26.11.2019
 * Time: 15:35
 */
 use  yii\bootstrap\ActiveForm;
?>
<?php
      $form = ActiveForm::begin(['class'=>'form-horizontal']);
?>
<?= $form->field($model,'username')->textInput(['autofocus'=>true]); ?>

<?= $form->field($model,'password')->passwordInput() ?>
    <div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
<?php
        ActiveForm::end();
?>