<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Categories */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Категорії', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="categories-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редагувати', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Видалити', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Ви впевнені, що бажаєте видалити обраний елемент?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_parent',
            'name',
            'img_url:url',
            'alias',
        ],
    ]) ?>

    <? if(isset($model->img_url) && !empty($model->img_url)):?>
    <div class="row">
        <div class="col-sm-12 ">
            <div class="img-wrapper-container">
                <div class="img-wrapper category-img">
                    <img src="<?= str_replace('admin-','',Url::home(true)).$model->img_url; ?>" alt="">
                    <a href="#" data-id="<?= $model->id ?>" title="Видалити зображення?"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
                </div>

            </div>
        </div>
    </div>
    <? endif; ?>

</div>
