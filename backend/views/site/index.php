<?php

/* @var $this yii\web\View */

$this->title = 'Плеяда. Адмінпанель';
$role = array_keys(Yii::$app->authManager->getRolesByUser(Yii::$app->user->id))[0];

?>

<div class="site-index">
    <h1>Вітаємо, <?= Yii::$app->user->identity->fio; ?></h1>
    <h4>Ви увійшли з правами <?= Yii::$app->authManager->getRolesByUser(Yii::$app->user->id)[ array_keys(Yii::$app->authManager->getRolesByUser(Yii::$app->user->id))[0]]->description;?></h4>
    <?php if ($role == 'superAdmin'):?>
        <div>Вам доступно використання всієї адмін панелі</div>
    <?php elseif ($role == 'admin'): ?>
        <div>Вам доступно Керування
            <ul>
                <li>Відгукама</li>
                <li>Товарами</li>
                <li>Замовленнями</li>
                <li>Контентом</li>
            </ul>
        </div>
    <?php elseif ($role == 'moderator'): ?>
        <div>Вам доступно Керування
            <ul>
                <li>Відгуками</li>
            </ul>
        </div>
    <?php elseif ($role == 'manager'): ?>
        <div>Вам доступно Керування
            <ul>
                <li>Відгукама</li>
                <li>Замовленнями</li>
            </ul>
        </div>
    <?php endif;?>



</div>
