<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
       /* 'css/site.css',
        'sbadminassets/css/sb-admin-2.min.css',
        'sbadminassets/vendor/fontawesome-free/css/all.min.css',*/
    ];
    public $js = [
       /* 'sbadminassets/vendor/jquery/jquery.min.js',
        'sbadminassets/vendor/bootstrap/js/bootstrap.bundle.min.js',
        'sbadminassets/vendor/jquery-easing/jquery.easing.min.js',
        'sbadminassets/js/sb-admin-2.min.js',*/
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap5\BootstrapAsset'
    ];
}
