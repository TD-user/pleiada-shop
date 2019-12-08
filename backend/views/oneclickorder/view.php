<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Oneclickorder */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'One click замовлення', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="oneclickorder-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редагувати', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Видалити', ['delete', 'id' => $model->id], [
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
            'created_at',
            'phone',
            'name',
            'surname',
            'email:email',
            'address',
            'total',
            //'products_json',
            'status',
            'is_payment',
            'comment',
        ],
    ]) ?>

    <div class="row">
        <div class="col-cs-12">
            <h2>Деталі замовлення</h2>
            <div class="row mb-10">
                <div class="col-sm-6 t-center">
                    Назва продукту
                </div>
                <div class="col-sm-2 t-center">
                    Ціна на момент замовлення
                </div>
                <div class="col-sm-2 t-center">
                    Кількість
                </div>
                <div class="col-sm-2 t-center">
                    Вартість
                </div>
            </div>
            <? foreach (json_decode($model->products_json) as $product): ?>
            <div class="row">
                <div class="col-sm-6">
                    <a href="<?= Url::to(['product/view', 'id' => $product->product_id])?>" target="_blank"><?= $product->name ?></a>
                </div>
                <div class="col-sm-2">
                    <?= number_format($product->price, 2)?>
                </div>
                <div class="col-sm-2">
                    <?= $product->count?>
                </div>
                <div class="col-sm-2">
                    <?= number_format($product->summa, 2)?>
                </div>
            </div>
            <? endforeach; ?>
        </div>
    </div>

</div>
