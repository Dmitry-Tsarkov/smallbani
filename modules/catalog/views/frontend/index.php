<?php

/**
 * @var $this \yii\web\View
 * @var \app\modules\catalog\models\Category[] $categories
 */

use app\modules\page\components\Pages;
use yii\helpers\Url;

Pages::getCurrentPage()->generateMetaTags();
$this->params['breadcrumbs'] = Pages::getBreadcrumbs();
$this->params['h1'] = Pages::getCurrentPage()->getH1();

$count = count($categories);

?>
<section class="section">
    <div class="container">
        <div class="section__body">
            <div class="catalog">
                <div class="grid is-row">
                    <?php foreach($categories as $key => $category):
                        $isLast = $count == $key+1;
                        $isOdd = $key % 2 == 1;
                        $isFirst = $key == 0;
                        $isBig = ($isLast && $isOdd) || $isFirst;
                    ?>
                        <div class="col-<?= $isBig ? '12' : '6' ?>">
                            <div class="catalog__section">
                                <a class="catalog__item" href="<?= Url::to(['/catalog/frontend/category', 'alias' => $category->alias])?>">
                                    <?php if ($category->hasImage()): ?>
                                        <img class="catalog__image" src="<?= $category->getThumbFileUrl('image', $isBig ? 'preview_big' : 'preview') ?>" alt="">
                                    <?php endif ?>
                                    <p class="catalog__text"><?= $category->title ?></p>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!--    <section class="section">-->
<!--        <div class="container">-->
<!--            <div class="section__body">-->
<!--                <div class="catalog">-->
<!--                    <div class="grid is-row">-->
<!--                        --><?php //foreach($categories as $key => $category):
//                            $isBig = $key % 5 == 0;
//                        ?>
<!--                            <div class="col---><?//= $isBig ? '12' : '6' ?><!--">-->
<!--                                <div class="catalog__section">-->
<!--                                    <a class="catalog__item" href="--><?//= Url::to(['/catalog/frontend/category', 'alias' => $category->alias])?><!--">-->
<!--                                        --><?php //if ($category->hasImage()): ?>
<!--                                            <img class="catalog__image" src="--><?//= $category->getThumbFileUrl('image', $isBig ? 'preview_big' : 'preview') ?><!--" alt="">-->
<!--                                        --><?php //endif ?>
<!--                                        <p class="catalog__text">--><?//= $category->title ?><!--</p>-->
<!--                                    </a>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        --><?php //endforeach; ?>
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </section>-->
