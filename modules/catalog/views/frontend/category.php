<?php

/**
 * @var $this \yii\web\View
 * @var \app\modules\catalog\models\Category $category
 * @var \yii\data\DataProviderInterface $dataProvider
 */

use app\modules\catalog\widgets\ProductWidget;
use app\modules\page\components\Pages;
use app\widgets\PaginationWidget;

$category->generateMetaTags();
$this->params['breadcrumbs'] = Pages::getParentBreadcrumbs('catalog');
$this->params['breadcrumbs'][] = $category->title;
$this->params['h1'] = $category->getH1();


?>
<section class="section is-products">
    <div class="container">
        <div class="section__body">
            <div class="products">
                <tabs inline-template>
                    <div class="tabs">
                        <div class="tabs__header">
                            <button class="tabs__tab" @click="toogle(1)" :class="{'is-active': tabId == 1}">Все бани</button>
                            <button class="tabs__tab" @click="toogle(2)" :class="{'is-active': tabId == 2}"> Баня-бочка круглая</button>
                            <button class="tabs__tab" @click="toogle(3)" :class="{'is-active': tabId == 3}">Квадробочка</button>
                            <button class="tabs__tab" @click="toogle(4)" :class="{'is-active': tabId == 4}">Овальные бани-бочки</button>
                        </div>
                        <div class="tabs__body">
                            <div class="tabs__item" v-if="tabId == 1">
                                <div class="grid is-row">
                                    <?php foreach ($dataProvider->getModels() as $product): ?>
                                        <div class="col-3">
                                            <?= ProductWidget::widget(compact('product')) ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="tabs__item" v-if="tabId == 2">
                                <div class="grid is-row">
                                    <div class="col-3"><a class="stock-small" href="/specials.html">
                                            <div class="stock-small__cover"><img class="stock-small__image" src="/img/stock-small.jpg" alt=""></div>
                                            <div class="stock-small__wrapper">
                                                <p class="stock-small__text">Специальные условия <br> для пенсионеров</p>
                                            </div></a>
                                    </div>
                                    <div class="col-3">
                                        <div class="product">
                                            <div class="product__cover"><img class="product__image" src="/img/product.jpg" alt=""></div>
                                            <h2 class="product__title">Дачный домик "Викинг"</h2>
                                            <div class="product__footer"><a class="button js-button is-product" area-label="Заказать за 178 000 ₽" href="/product-detailed.html">Заказать за 178 000 ₽</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="product">
                                            <div class="product__cover"><img class="product__image" src="/img/product.jpg" alt=""></div>
                                            <h2 class="product__title">Дачный домик "Викинг"</h2>
                                            <div class="product__footer"><a class="button js-button is-product" area-label="Заказать за 178 000 ₽" href="/product-detailed.html">Заказать за 178 000 ₽</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="product">
                                            <div class="product__cover"><img class="product__image" src="/img/product.jpg" alt=""></div>
                                            <h2 class="product__title">Дачный домик "Викинг"</h2>
                                            <div class="product__footer"><a class="button js-button is-product" area-label="Заказать за 178 000 ₽" href="/product-detailed.html">Заказать за 178 000 ₽</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="product">
                                            <div class="product__cover"><img class="product__image" src="/img/product.jpg" alt=""></div>
                                            <h2 class="product__title">Дачный домик "Викинг"</h2>
                                            <div class="product__footer"><a class="button js-button is-product" area-label="Заказать за 178 000 ₽" href="/product-detailed.html">Заказать за 178 000 ₽</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="product">
                                            <div class="product__cover"><img class="product__image" src="/img/product.jpg" alt=""></div>
                                            <h2 class="product__title">Дачный домик "Викинг"</h2>
                                            <div class="product__footer"><a class="button js-button is-product" area-label="Заказать за 178 000 ₽" href="/product-detailed.html">Заказать за 178 000 ₽</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="product">
                                            <div class="product__cover"><img class="product__image" src="/img/product.jpg" alt=""></div>
                                            <h2 class="product__title">Дачный домик "Викинг"</h2>
                                            <div class="product__footer"><a class="button js-button is-product" area-label="Заказать за 178 000 ₽" href="/product-detailed.html">Заказать за 178 000 ₽</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="product">
                                            <div class="product__cover"><img class="product__image" src="/img/product.jpg" alt=""></div>
                                            <h2 class="product__title">Дачный домик "Викинг"</h2>
                                            <div class="product__footer"><a class="button js-button is-product" area-label="Заказать за 178 000 ₽" href="/product-detailed.html">Заказать за 178 000 ₽</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tabs__item" v-if="tabId == 3">
                                <div class="grid is-row">
                                    <div class="col-3">
                                        <div class="product">
                                            <div class="product__cover"><img class="product__image" src="/img/product.jpg" alt=""></div>
                                            <h2 class="product__title">Дачный домик "Викинг"</h2>
                                            <div class="product__footer"><a class="button js-button is-product" area-label="Заказать за 178 000 ₽" href="/product-detailed.html">Заказать за 178 000 ₽</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3"><a class="stock-small" href="/specials.html">
                                            <div class="stock-small__cover"><img class="stock-small__image" src="/img/stock-small.jpg" alt=""></div>
                                            <div class="stock-small__wrapper">
                                                <p class="stock-small__text">Специальные условия <br> для пенсионеров</p>
                                            </div></a>
                                    </div>
                                    <div class="col-3">
                                        <div class="product">
                                            <div class="product__cover"><img class="product__image" src="/img/product.jpg" alt=""></div>
                                            <h2 class="product__title">Дачный домик "Викинг"</h2>
                                            <div class="product__footer"><a class="button js-button is-product" area-label="Заказать за 178 000 ₽" href="/product-detailed.html">Заказать за 178 000 ₽</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tabs__item" v-if="tabId == 4">
                                <div class="grid is-row">
                                    <div class="col-3">
                                        <div class="product">
                                            <div class="product__cover"><img class="product__image" src="/img/product.jpg" alt=""></div>
                                            <h2 class="product__title">Дачный домик "Викинг"</h2>
                                            <div class="product__footer"><a class="button js-button is-product" area-label="Заказать за 178 000 ₽" href="/product-detailed.html">Заказать за 178 000 ₽</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="product">
                                            <div class="product__cover"><img class="product__image" src="/img/product.jpg" alt=""></div>
                                            <h2 class="product__title">Дачный домик "Викинг"</h2>
                                            <div class="product__footer"><a class="button js-button is-product" area-label="Заказать за 178 000 ₽" href="/product-detailed.html">Заказать за 178 000 ₽</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="product">
                                            <div class="product__cover"><img class="product__image" src="/img/product.jpg" alt=""></div>
                                            <h2 class="product__title">Дачный домик "Викинг"</h2>
                                            <div class="product__footer"><a class="button js-button is-product" area-label="Заказать за 178 000 ₽" href="/product-detailed.html">Заказать за 178 000 ₽</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </tabs>
                <?= PaginationWidget::widget(['pagination' => $dataProvider->pagination]) ?>
            </div>
        </div>
    </div>
</section>
