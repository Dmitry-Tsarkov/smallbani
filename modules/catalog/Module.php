<?php

namespace app\modules\catalog;

use yii\base\BootstrapInterface;

class Module extends \yii\base\Module implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->urlManager->addRules([
            '/catalog'  => '/catalog/frontend/index',
            '/catalog/<alias>' => '/catalog/frontend/category',
            '/product/<alias>' => '/catalog/frontend/product',
        ]);
    }
}
