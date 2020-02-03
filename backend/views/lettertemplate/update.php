<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\LetterTemplate */

$this->title = 'Редагувати шаблон: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Шаблони листів', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редагувати';
?>
<div class="letter-template-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
