<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'category_id',
            'code_1c',
            'parent_code_1c',
            'name',
            'price',
            'promotionPrice',
            'currency',
            'remains',
            'unit',
            'article',
            'manufacturer',
            'description',
            'alias',
        ],
    ]) ?>

    <div class="row">
        <div class="col-sm-12">
            <? foreach ($model->getImages()->all() as $image): ?>
                <img src="<?= Yii::getAlias('@frontend') . '/web'.$image->path; ?>" alt="">
            <? endforeach; ?>
        </div>
    </div>

</div>
