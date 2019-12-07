<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Oneclickorder */

$this->title = 'Update Oneclickorder: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Oneclickorders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="oneclickorder-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
