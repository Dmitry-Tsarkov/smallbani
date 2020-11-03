<?php



/**
 * @var $this \yii\web\View
 * @var \app\modules\catalog\models\Product $product
 */

?>

<div class="product">
    <div class="product__cover">
        <?php if ($product->hasMainImage()): ?>
            <img class="product__image" src="<?= $product->getMainImagePreview() ?>" alt="">
        <?php endif ?>
    </div>
    <h2 class="product__title"><?= $product->title; ?></h2>
    <div class="product__footer"><a class="button js-button is-product" area-label="Заказать за 178 000 ₽" href="<?= $product->getHref() ?>">Заказать за 178 000 ₽</a>
    </div>
</div>
