<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\LetterTemplate */

$this->title = 'Створити шаблон';
$this->params['breadcrumbs'][] = ['label' => 'Шаблони листів', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="letter-template-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
