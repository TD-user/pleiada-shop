<?php

use yii\debug\models\search\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Admin */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Admins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="admin-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            ['attribute' => 'Роль',
                'value' => function ($model) {
                    return Yii::$app->authManager->getRolesByUser($model->id)[ array_keys(Yii::$app->authManager->getRolesByUser($model->id))[0]]->description;
                },
            ],
            'auth_key',
            'password_hash',
            'password_reset_token',
            'created_at',
            'updated_at',
            'fio',
        ],
    ]) ?>

</div>
