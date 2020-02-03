<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Letter */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Листи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="letter-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редагувати', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Видалити', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Ви впевнені, що хочете видалити лист?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Розіслати підписникам', null, ['class' => 'btn btn-success', 'id' => 'send-letter-btn', 'letter-id' => $model->id]) ?>
    </p>

    <div id="status-wrapper">
        статус...
    </div>

    <div class="progress-bar-wrapper">
        <div id="progress-bar"></div>
    </div>

    <div class="test-letter mb-30">
        <p>Надістлати тестовий лист (вкажіть email):</p>
        <div>
            <?= Html::textInput('test-letter', null, ['class' => 'form-control mb-15', 'id' => 'test-letter-email'])?>
            <?= Html::button('Надіслати пробний лист', ['class' => 'btn btn-primary mb-15', 'id' => 'send-test-letter-btn', 'letter-id' => $model->id])?>
            <div id="test-status-wrapper">
                статус...
            </div>
        </div>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'body:ntext',
            'created_at:datetime',
            'admin_id',
            'status',
        ],
    ]) ?>

</div>

<?php $this->registerJsFile("@web/js/sendEmailScript.js", ['depends' => [\yii\web\JqueryAsset::className()]]);?>
