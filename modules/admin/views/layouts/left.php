<?php

use dmstr\widgets\Menu;

?>

<aside class="main-sidebar">
    <section class="sidebar">
        <?= Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'encodeLabels' => false,
                'items' => [
                    [
                        'label' => 'Главная',
                        'icon' => 'home',
                        'url' => Yii::$app->getHomeUrl(),
                    ],
                    [
                        'label' => 'Каталог',
                        'icon' => 'cogs',
                        'items' => [
                            [
                                'label' => 'Товары',
                                'icon' => 'users',
                                'url' => ['/catalog/backend/product/index'],
                                'active' => Yii::$app->controller->module->id == 'catalog' && Yii::$app->controller->id == 'backend/product',
                            ],
                            [
                                'label' => 'Категории',
                                'icon' => 'user',
                                'url' => ['/catalog/backend/category/index'],
                                'active' => Yii::$app->controller->module->id == 'catalog' && Yii::$app->controller->id == 'backend/category',

                            ],
                        ],
                    ],
                    [
                        'label' => 'Настройки',
                        'icon' => 'cogs',
                        'items' => [
                            [
                                'label' => 'Пользователи',
                                'icon' => 'users',
                                'url' => ['/user/backend/index'],
                                'active' => Yii::$app->controller->module->id == 'user',
                            ],
                        ],
                    ],
                ],
            ]
        ) ?>
    </section>
</aside>