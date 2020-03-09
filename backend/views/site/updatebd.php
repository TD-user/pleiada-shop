<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 12.12.2019
 * Time: 14:15
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
$session = Yii::$app->session;
$this->registerJs(<<<JS
 $(document).on('pjax:send', function() {
     $('#loading').show(); $('#loadingIMG').hide(); $('#load1').hide()} );

JS
);
?>
<?php Pjax::begin(['timeout' => false]); ?>

<?php $form = ActiveForm::begin([ 'action' => Url::to(['site/upload']),'options' => ['enctype' => 'multipart/form-data','data-pjax' => '']]) ?>

    <h1>Оновлення бази товарів</h1>
<ul >
    <li><h4>Нові товари з 1с, повинні бути в файлі з розширенням .xml</h4> </li>
    <li><h4>Усі товари які є в базі оновлюються, яких немає створюються</h4></li>
    <li><h4>Усі акційні товари не змінюють свою акційну ціну</h4> </li>

</ul>
    <?= $form->field($model, 'path')->label('Виберіть файл XML')->fileInput(['class'=>'btn btn-primary']) ?>
    <h3  id = "load" ><?=$process?></h3>
    <div id='loading'  style="display: none;"><h3>Завантаження ...</h3></div>
    <input type="submit"  class="btn btn-success"  value="Завантажити" >
<?php ActiveForm::end() ?>
<?php Pjax::end(); ?>
<?php $form = ActiveForm::begin(['action' => Url::to(['site/img']),'options' => ['enctype' => 'multipart/form-data','data-pjax' => '' ]]) ?>
    <h1>Зантаження картинок до Бази даних</h1>
<ul >
    <li><h4>Завантажити картинки на сервер за шляхом /img/products</h4> </li>
    <li><h4>Натиснути кнопку "Завантажити картинки"</h4> </li>
    <li><h4>Дочекатись повідомлення "Файли успішно додані!"</h4></li>
</ul>
    <h3 id = "load1"><?=$processIMG?></h3>
    <input type="submit"  class="btn btn-success" value="Завантажити картинки"  >
<?php ActiveForm::end() ?>











