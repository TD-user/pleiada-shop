<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',

        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'cache' => 'cache'
        ],

    ],
    'modules' => [
        'liqpay' => [
            'class' => 'borysenko\liqpay\Module',
            'public_key' => 'sandbox_i78141231246',
            'private_key' => 'sandbox_znqMFJGzuzxKmsRutcal9xkIvIh0EkHw8ravVmlr',
            'currency' => 'UAH',
            'pay_way' => null,
            'version' => 3,
            'sandbox' => false,
            'language' => 'ru',
            'result_url' => '/site/index',
            'paymentName' => 'Оплата замовлення',
            'orderModel' => 'common\models\Order', //Модель заказа. Эта модель должна имплементировать интерфейс borysenko\liqpay\interfaces\Order. В момент списания денег будет вызываться $model->setPaymentStatus('yes').
        ],
    ],
];
