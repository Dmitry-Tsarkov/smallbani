<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;

/**
 * @var string $content
 */

?>

<div class="content-wrapper">
    <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], 'options' => ['style' => 'margin-bottom:0', 'class' => 'breadcrumb']]) ?>
    <?php if (isset($this->blocks['content-header'])): ?>
        <?= $this->blocks['content-header'] ?>
    <?php elseif (!empty($this->title)): ?>
        <section class="content-header">
            <h1><?= Html::encode($this->title) ?></h1>
        </section>
    <?php endif ?>

    <section class="content">
        <?= Alert::widget() ?>
        <?= $content ?>
    </section>
</div>
