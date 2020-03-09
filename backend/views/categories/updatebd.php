<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 12.12.2019
 * Time: 14:15
 */

use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
$session = Yii::$app->session;
$this->registerJs(<<<JS
       $(document).on('pjax:send', function() { $('#loading').show()});
JS
);
?>


<?php Pjax::begin(['timeout' => false]); ?>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data','data-pjax' => '']]) ?>
    <h1>Оновлення Категорій</h1>
    <?php echo $session->getFlash('lala')?>
    <?= $form->field($model, 'path')->label('Виберіть файл XML',['class'=>'btn btn-primary'])->fileInput(['class'=>'sr-only'] ) ?>
    <h3><?=$process?></h3>
    <div id='loading'  style="display: none;"><h3>Завантаження ...</h3></div>
    <button  class="btn btn-success" >Завантажити</button>

<?php ActiveForm::end() ?>


<?php Pjax::end(); ?>

