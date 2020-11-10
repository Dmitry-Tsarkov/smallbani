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
                        'label' => 'Страницы',
                        'icon' => 'home',
                        'url' => ['/page/backend/default/index'],
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
                            [
                                'label' => 'Цвета',
                                'icon' => 'user',
                                'url' => ['/colour/backend/colour/index'],
                                'active' => Yii::$app->controller->module->id == 'colour' && Yii::$app->controller->id == 'backend/colour',

                            ],
                            [
                                'label' => 'Характеристики',
                                'icon' => 'user',
                                'url' => ['/characteristic/backend/characteristic/index'],
                                'active' => Yii::$app->controller->module->id == 'characteristic' && Yii::$app->controller->id == 'backend/characteristic',
                            ],
                        ],
                    ],
                    [
                        'label' => 'Заказы',
                        'icon' => 'users',
                        'url' => ['/order/backend/order/index'],
                        'active' => Yii::$app->controller->module->id == 'order',
                    ],
                    [
                        'label' => 'Портфолио',
                        'icon' => 'cogs',
                        'items' => [
                            [
                                'label' => 'Портфолио',
                                'icon' => 'users',
                                'url' => ['/portfolio/backend/portfolio/index'],
                                'active' => Yii::$app->controller->module->id == 'portfolio' && Yii::$app->controller->id == 'backend/portfolio',
                            ],
                            [
                                'label' => 'Категории',
                                'icon' => 'edit',
                                'url' => ['/portfolio/backend/category/index'],
                                'active' => Yii::$app->controller->module->id == 'portfolio' && Yii::$app->controller->id == 'backend/category',
                            ],
                        ],
                    ],
                    [
                        'label' => 'Контент',
                        'icon' => 'adjust',
                        'items' => [
                            [
                                'label' => 'Вопрос-ответ',
                                'icon' => 'user',
                                'url' => ['/faq/backend/question/index'],
                                'active' => Yii::$app->controller->module->id == 'faq',
                            ],
                            [
                                'label' => 'Слайдер',
                                'icon' => 'users',
                                'url' => ['/slide/backend/slide/index'],
                                'active' => Yii::$app->controller->module->id == 'slide' && Yii::$app->controller->id == 'backend/slide',
                            ],
                        ],
                    ],
                    [
                        'label' => 'Отзывы',
                        'icon' => 'edit',
                        'url' => ['/review/backend/review/index'],
                        'active' => Yii::$app->controller->module->id == 'review' && Yii::$app->controller->id == 'backend/review',
                    ],
                    [
                        'label' => 'Акции',
                        'icon' => 'adjust',
                        'url' => ['/actions/backend/actions/index'],
                        'active' => Yii::$app->controller->module->id == 'actions',
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
