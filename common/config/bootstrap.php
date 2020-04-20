<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');

Yii::setAlias('@www', dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'pleiada');
Yii::setAlias('@admin', dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'admin-pleiada');

