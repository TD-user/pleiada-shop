<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SubscriberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Підписники';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subscriber-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавити підписника', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'email:email',
            ['attribute' => 'created_at',
                'value' => function ($model, $key, $index, $grid) {
                    return date('d/m/Y H:i:s', $model->created_at);
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
