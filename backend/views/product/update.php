<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = 'Редагувати товар: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Товари', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formUpload', [
        'model' => $model,
        'categories' => $categories,
        'modelUploadImgs' => $modelUploadImgs,
    ]) ?>

</div>
