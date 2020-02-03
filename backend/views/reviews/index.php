<?php

use common\models\Product;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ReviewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Відгуки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reviews-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'product_id',
            ['attribute' => 'product',
                'value' => function ($model, $key, $index, $grid) {
                    return Product::findOne($model->product_id)->name;
                },
            ],
            'user_id',
            'name',
            'text',
            ['attribute' => 'created_at',
                'value' => function ($model, $key, $index, $grid) {
                    return date('d/m/Y H:i:s', $model->created_at);
                },
            ],
            ['attribute' => 'moderated_at',
                'value' => function ($model, $key, $index, $grid) {
                    return date('d/m/Y H:i:s', $model->moderated_at);
                },
            ],
            //'created_at',
            //'is_moderated',
            //'moderator_id',
            //'moderated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
