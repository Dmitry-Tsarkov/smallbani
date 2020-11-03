<?php

namespace app\bootstrap;


use app\modules\catalog\repositories\ProductRepository;
use app\modules\catalog\services\ProductRepositoryInterface;
use yii\base\BootstrapInterface;
use yii\di\Container;

class SetUp implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $container = \Yii::$container;

        $container->set(ProductRepositoryInterface::class, ProductRepository::class);
    }
}