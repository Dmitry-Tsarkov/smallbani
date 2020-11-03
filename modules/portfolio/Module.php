<?php


namespace app\modules\portfolio;

use yii\base\BootstrapInterface;

class Module extends \yii\base\Module implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->urlManager->addRules([
            '/portfolio'  => '/portfolio/frontend/index',
            '/portfolio/<alias>'  => '/portfolio/frontend/category',
            '/portfolio/<category>/<alias>'  => '/portfolio/frontend/view',
        ]);
    }
}
