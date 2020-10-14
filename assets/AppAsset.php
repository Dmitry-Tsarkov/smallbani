<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use Yii;
use yii\web\AssetBundle;
use yii\web\JqueryAsset;

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

    public function init()
    {
        $jqueryBundle = Yii::$app->getAssetManager()->getBundle(JqueryAsset::class);
        $jqueryBundle->js = [];
        $jqueryBundle->depends = [AppAsset::class];

        parent::init();
    }

    public $css = [
        'css/style.css',
    ];
    public $js = [
        'js/app.js',
    ];
}
