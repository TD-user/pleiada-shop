<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Mainslider */

$this->title = 'Слайд: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Головний слайдер', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mainslider-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelUpload' => $modelUpload,
    ]) ?>

</div>
