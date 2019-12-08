<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Mainslider */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Головний слайдер', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="mainslider-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редагувати', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Видалити', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Бажаєте видали слайд?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'path',
            'title',
        ],
    ]) ?>

    <div class="row">
        <div class="col-sm-12 ">
            <div class="img-wrapper-max">
                <img src="<?= str_replace('admin.','',Url::home(true)).$model->path; ?>" alt="">
            </div>
        </div>
    </div>

</div>
