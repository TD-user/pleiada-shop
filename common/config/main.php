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
            'public_key' => 'iNNNNNNNNNNN',
            'private_key' => 'NzpRclCywaSOrm0LTpqDpPPlRDhoOQyIX1ISHjk',
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
