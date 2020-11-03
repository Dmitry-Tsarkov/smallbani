<?php


namespace app\modules\actions;

use yii\base\BootstrapInterface;

class Module extends \yii\base\Module implements BootstrapInterface
{

    public function bootstrap($app)
    {
        $app->urlManager->addRules([
            '/stocks'  => '/actions/frontend/index',
            '/specials/<alias>' => '/actions/frontend/view',
        ]);
    }
}
