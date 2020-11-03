<?php


namespace app\modules\order;


use yii\base\BootstrapInterface;

class Module extends \yii\base\Module implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->urlManager->addRules([]);
    }
}
