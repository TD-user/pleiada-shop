<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\LetterSearh */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Листи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="letter-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Створити лист', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'title',
            //'body:ntext',
            ['attribute' => 'created_at',
                'value' => function ($model, $key, $index, $grid) {
                    return date('d/m/Y H:i:s', $model->created_at);
                },
            ],
            //'admin_id',
            'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
