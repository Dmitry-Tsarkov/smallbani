<?php

/**
 * @var \yii\web\View $this
 * @var \app\modules\catalog\models\Product $product
 * @var array $categoriesDropDown
 */

$this->title = 'Добавление товара';
$this->params['breadcrumbs'] = [
    ['label' => 'Товары', 'url' => ['/catalog/backend/product/index']],
    $product->title,
];

?>


<div class="box box-default">
    <div class="box-body">
        <?= $this->render('_form', compact('product', 'categoriesDropDown')) ?>
    </div>
</div>
