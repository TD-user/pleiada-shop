<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Oneclickorder */

$this->title = 'Create Oneclickorder';
$this->params['breadcrumbs'][] = ['label' => 'Oneclickorders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oneclickorder-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
