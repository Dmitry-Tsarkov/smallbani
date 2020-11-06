<?php

namespace app\bootstrap;

use yii\base\BootstrapInterface;
use yii\mail\MailerInterface;

class SetUp implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $container = \Yii::$container;

        $container->set(MailerInterface::class, function () {
            return \Yii::$app->mailer;
        });
    }
}
