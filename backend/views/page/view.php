<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Htmlpages */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Htmlpages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="htmlpages-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редагувати', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
<!--        --><?//= Html::a('Видалити', ['delete', 'id' => $model->id], [
//            'class' => 'btn btn-danger',
//            'data' => [
//                'confirm' => 'Ви впевнені, що бажаєте видалити цю сторінку?',
//                'method' => 'post',
//            ],
//        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            //'alias',
        ],
    ]) ?>

</div>
