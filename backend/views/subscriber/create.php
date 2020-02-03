<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Subscriber */

$this->title = 'Добавити підписника';
$this->params['breadcrumbs'][] = ['label' => 'Підписники', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subscriber-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
