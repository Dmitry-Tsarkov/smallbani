<?php

/**
 * @var $this \yii\web\View
 * @var \app\modules\actions\models\Promo[] $actions
 * @var \yii\data\DataProviderInterface $dataProvider
 */

use app\modules\page\components\Pages;
use app\widgets\PaginationWidget;
use yii\helpers\Url;

Pages::getCurrentPage()->generateMetaTags();
$this->params['breadcrumbs'] = Pages::getBreadcrumbs();
$this->params['h1'] = Pages::getCurrentPage()->getH1();

?>
        <section class="section">
            <div class="container">

               <div class="section__body">
                    <div class="grid is-row">
                        <?php foreach($dataProvider->getModels() as $action):
                            /** @var \app\modules\actions\models\Promo $action */
                        ?>
                            <div class="col-4">
                                <a class="is-big stock-small" href="<?= $action->getHref() ?>">
                                    <div class="stock-small__cover"><img class="stock-small__image" src="<?= $action->getThumbFileUrl('image', 'preview') ?>" alt=""></div>
                                    <div class="stock-small__wrapper">
                                        <p class="stock-small__text"><?= $action->title?></p>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach;?>
                    </div>
                   <?= PaginationWidget::widget(['pagination' => $dataProvider->pagination]) ?>
                </div>
            </div>
        </section>
