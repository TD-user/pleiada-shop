<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Товари', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редагувати', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Видалити', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Ви впевнені, що бажаєте видалити цей товар?',
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
            <div class="img-wrapper-container">
            <? foreach ($model->getImages()->all() as $image): ?>
            <div class="img-wrapper">
                <img src="<?= str_replace('admin-','',Url::home(true)).$image->path; ?>" alt="">
                <a href="#" data-id="<?= $image->id ?>" title="Видалити зображення?"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
            </div>
            <? endforeach; ?>
            </div>
        </div>
    </div>

</div>
