<?php

/**
 * @var \yii\web\View $this
 * @var \app\modules\catalog\models\Product $product
 * @var array $categoriesDropDown
 */

$this->title = 'Редактирование товара: ' . $product->title;
$this->params['breadcrumbs'] = [
    ['label' => 'Товар', 'url' => ['index']],
    $product->title,
];

?>

<?php $this->beginContent('@app/modules/catalog/views/backend/product/layout.php', compact('product')) ?>

<?= $this->render('_form', compact('product', 'categoriesDropDown')) ?>

<?php $this->endContent() ?>
