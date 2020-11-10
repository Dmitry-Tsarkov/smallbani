<?php


namespace app\modules\characteristic;


use yii\base\BootstrapInterface;

class Module extends \yii\base\Module implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->urlManager->addRules([

        ]);
    }
}
