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
        'css/style.css?v=17',
        'css/changedStyle.css?v=1',
    ];
    public $js = [
        'js/main.js?v=9',
        'js/ajaxToServer.js?v=12',
        'js/bootstrap-slider.min.js',
        'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
