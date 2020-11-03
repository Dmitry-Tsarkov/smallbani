<?php

use yii\widgets\Breadcrumbs;

/**
 * @var $this \yii\web\View
 * @var array $links
 */

?>

<?= Breadcrumbs::widget([
    'itemTemplate' => "<li class='breadcrumb__item'>{link}</li>",
    'activeItemTemplate' => "<li class='breadcrumb__item'>{link}</li>",
    'homeLink' => false,
    'links' => $links,
]) ?>
