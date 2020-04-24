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
<ul >
    <li><h4>Нові категорії з 1с, повинні бути в файлі з розширенням .xml</h4> </li>
    <li><h4>Після оновлення бази, категорії які не використовуються не видаляються потрібно видалити вручу</h4></li>
    <li><h4>Після оновлення категорій потрібно обов'язково оновити базу товарів автоматично</h4> </li>

</ul>
    <?= $form->field($model, 'path')->label('Виберіть файл XML')->fileInput(['class'=>'btn btn-primary'] ) ?>
    <h3><?=$process?></h3>
    <div id='loading'  style="display: none;"><h3>Завантаження ...</h3></div>
    <button  class="btn btn-success" >Завантажити</button>

<?php ActiveForm::end() ?>
<?php Pjax::end(); ?>

