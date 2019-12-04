<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Reviews */

$this->title = 'Модерація відгуку про: ' . $model->getProduct()->one()->name;
$this->params['breadcrumbs'][] = ['label' => 'Відгуки', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->getProduct()->one()->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Модерація';
?>
<div class="reviews-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
