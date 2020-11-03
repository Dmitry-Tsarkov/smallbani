<?php

use app\modules\page\components\Pages;
use app\modules\review\widgets\ReviewWidget;
use app\widgets\PaginationWidget;

/**
 * @var $this \yii\web\View
 * @var \app\modules\review\models\Review[] $reviews
 * @var \yii\data\DataProviderInterface $dataProvider
 */

Pages::getCurrentPage()->generateMetaTags();
$this->params['breadcrumbs'] = Pages::getBreadcrumbs();
$this->params['h1'] = Pages::getCurrentPage()->getH1();

?>

<section class="section is-reviews">
    <div class="container">
        <div class="section__body">
            <p style="font-size: 20px; line-height: 28px; color: $dark; padding-bottom: 20px; border-bottom: 1px solid #C4C4C4; margin-bottom: 40px; width: 670px">
                Наша компания занимается изготовлением бань эконом-класса. Основной заказчик — люди, желающие получить
                высокое качество изделия при небольших затратах. Поверьте, попарившись в такой бане, вам не захочется
                больше отказывать себе в маленьких удовольствиях</p>
            <div class="grid is-row">
            <?php foreach ($dataProvider->getModels() as $review): ?>
                <div class="col-6">
                    <?= ReviewWidget::widget(compact('review')) ?>
                </div>
            <?php endforeach;?>
                <div class="col-12">
                    <div class="pagination">
                        <ul class="pagination__list">
                            <?= PaginationWidget::widget(['pagination' => $dataProvider->pagination]);?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

