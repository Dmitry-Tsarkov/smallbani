<?php

/**
 * @var $this \yii\web\View
 * @var \yii\data\Pagination $pagination
 */

?>

<?php if ($pagination->pageCount > 1): ?>
    <div class="pagination">
        <?= \yii\widgets\LinkPager::widget([
            'pagination' => $pagination,
            'activePageCssClass' => 'is-active',
            'options' => ['class' => 'pagination__list'],
            'linkContainerOptions' => ['class' => 'pagination__item'],
            'linkOptions' => ['class' => 'pagination__link'],
            'nextPageLabel' => false,
            'prevPageLabel' => false
        ]) ?>
    </div>
<?php endif ?>
