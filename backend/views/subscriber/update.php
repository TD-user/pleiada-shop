<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Subscriber */

$this->title = 'Редагувати підписника: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Підписники', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редагувати';
?>
<div class="subscriber-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
