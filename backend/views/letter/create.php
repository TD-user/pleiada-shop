<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Letter */

$this->title = 'Створити лист';
$this->params['breadcrumbs'][] = ['label' => 'Листи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="letter-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
