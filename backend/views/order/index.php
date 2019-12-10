<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Замовлення';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'created_at',
            ['attribute' => 'created_at',
                'value' => function ($model, $key, $index, $grid) {
                    return date('d/m/Y H:i:s', $model->created_at);
                },
            ],
            //'user_id',
            'email:email',
            'phone',
            'name',
            'surname',
            'address',
            'total',
            //'products_json',
            'status',
            //'is_payment',
            //'comment',
            //'comment_admin',
            //'methodPayment',
            //'methodDelivery',
            //'cost',
            'payment',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
