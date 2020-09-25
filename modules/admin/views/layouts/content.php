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
    <?php if (isset($this->blocks['content-header']) || !empty($this->title) || !empty($this->params['breadcrumbs'])): ?>
        <section class="content-header">
            <?php if (isset($this->blocks['content-header'])): ?>
                <h1><?= $this->blocks['content-header'] ?></h1>
            <?php else: ?>
                <h1><?= Html::encode($this->title) ?></h1>
            <?php endif ?>
        </section>
    <?php endif ?>

    <section class="content">
        <?= Alert::widget() ?>
        <?= $content ?>
    </section>
</div>