<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Mainslider */

$this->title = 'Додати слайд';
$this->params['breadcrumbs'][] = ['label' => 'Головний слайдер', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mainslider-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelUpload' => $modelUpload,
    ]) ?>

</div>
