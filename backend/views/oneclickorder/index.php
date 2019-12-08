<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\OneclickorderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'One click замовлення';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oneclickorder-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'created_at',
            ['attribute' => 'created_at',
                'value' => function ($model, $key, $index, $grid) {
                    return date('d/m/Y H:i:s', $model->created_at);
                },
            ],
            'phone',
            //'name',
            //'surname',
            //'email:email',
            //'address',
            'total',
            //'products_json',
            //'status',
            //'is_payment',
            //'comment',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
