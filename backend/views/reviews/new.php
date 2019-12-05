<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\Product;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ReviewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Відгуки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reviews-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'product_id',
            ['attribute' => 'product',
                'value' => function ($model, $key, $index, $grid) {
                    return Product::find($model->product_id)->one()->name;
                },
            ],
            'user_id',
            'name',
            'text',
            //'created_at:date',
            ['attribute' => 'created_at',
                'value' => function ($model, $key, $index, $grid) {
                    return date('Y-m-d H:i:s', $model->created_at);
                },
            ],
            //'is_moderated',
            //'moderator_id',
            //'moderated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
