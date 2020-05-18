<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/bootstrap-slider.min.css',
        'css/style.css?v=16',
        'css/changedStyle.css?v=4',
        'libs/MP_Toasts/MP_Toasts.css?v=1',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css',
    ];
    public $js = [
        'libs/MP_Toasts/MP_Toasts.js?v=1',
        'js/main.js?v=2',
        'js/ajaxToServer.js?v=1',
        'js/bootstrap-slider.min.js',
        'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}