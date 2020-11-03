<?php

/**
 * @var $this \yii\web\View
 * @var \app\modules\actions\models\Promo $action
 */

use app\modules\page\components\Pages;
use yii\helpers\Url;

$action->generateMetaTags();
$this->params['breadcrumbs'] = Pages::getParentBreadcrumbs('stocks');
$this->params['breadcrumbs'][] = $action->title;
$this->params['h1'] = $action->title;

?>

<main class="page__content">
    <section class="section">
        <div class="container">
            <div class="section__body">
                <div class="special">
                    <div class="grid is-row">
                        <div class="col-12"><img class="special__image" src="<?= $action->getThumbFileUrl('image', 'view') ?>" alt=""></div>
                        <div class="col-6">
                            <p class="special__text"><?= $action->description?></p>
                            <div class="special__buttons"><a class="button js-button is-product" area-label="Перезвоните мне" href="/product-detailed.html">Перезвоните мне</a><a class="button js-button unfill" area-label="Смотреть все акции" href="<?= Url::to(['/actions/frontend/index'])?>">Смотреть все акции</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
