<?php

use app\modules\page\components\Pages;

/**
 * @var yii\web\View $this
 * @var \app\modules\page\models\Page $page
 */

$this->params['breadcrumbs'] = Pages::getBreadcrumbs();
Pages::getCurrentPage()->generateMetaTags();
$this->params['h1'] = Pages::getCurrentPage()->getH1();

?>

<section class="section">
    <div class="container">
        <div class="section__body">
            <div class="text">
                <?= Pages::getCurrentPage()->content ?>
            </div>
        </div>
    </div>
</section>
