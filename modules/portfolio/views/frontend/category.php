<?php

use app\modules\page\components\Pages;
use app\modules\portfolio\widget\PortfolioWidget;
use app\widgets\PaginationWidget;
use yii\helpers\Url;

/**
 * @var \yii\web\View $this
 * @var \yii\data\DataProviderInterface $dataProvider
 * @var \app\modules\portfolio\models\PortfolioCategory $currentCategory
 * @var \app\modules\portfolio\models\PortfolioCategory[] $categories
 */

Pages::getPage('portfolio')->generateMetaTags();
$this->params['breadcrumbs'] = Pages::getParentBreadcrumbs('portfolio');
$this->params['breadcrumbs'][] = $currentCategory->title;
$this->params['h1'] = Pages::getPage('portfolio')->getH1();

?>

<section class="section is-reviews">
    <div class="container">
        <div class="section__body">
            <portfolio inline-template>
                <div class="portfolio">
                    <div class="portfolio__header">

                        <a href="<?= Url::to(['/portfolio/frontend/index']) ?>" class="portfolio__tab">Все</a>

                        <?php foreach($categories as $category): ?>
                            <a href="<?= $category->getHref() ?>" class="portfolio__tab <?= $currentCategory->id == $category->id ? 'is-active' : '' ?>"  ><?= $category->title?></a>
                        <?php endforeach; ?>

                    </div>
                    <div class="portfolio__body">
                        <div class="portfolio__item">
                            <div class="portfolio-item">
                                <?php foreach($dataProvider->getModels() as $portfolio): ?>
                                    <?= PortfolioWidget::widget(compact('portfolio')) ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="pagination">
                        <ul class="pagination__list">
                            <?= PaginationWidget::widget(['pagination' => $dataProvider->pagination]);?>
                        </ul>
                    </div>
                </div>
            </portfolio>
        </div>
    </div>
</section>
