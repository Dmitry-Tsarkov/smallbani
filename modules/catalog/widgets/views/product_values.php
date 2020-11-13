<?php

/**
 * @var $this \yii\web\View
 * @var \app\modules\characteristic\models\Value[] $basicValues
 * @var \app\modules\characteristic\models\Value[] $additionalValues
 */

?>

<?php if (!empty($basicValues) || !empty($additionalValues)): ?>
    <div class="product-description__body">
        <?php if (!empty($basicValues)): ?>
            <div class="product-description__params">
                <div class="product-description__complectation">
                    <p class="product-description__title">Базовая комплектация</p>
                </div>
                <?php foreach ($basicValues as $value): ?>
                    <div class="product-description__option">
                        <p class="product-description__subtitle"><b><?= $value->getLabel() ?></b></p>
                        <p class="product-description__subtitle"><?= $value->getText(); ?> <?= $value->getUnit() ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif ?>
        <?php if (!empty($additionalValues)): ?>
            <div class="product-description__params">
                <div class="product-description__complectation">
                    <p class="product-description__title">Дополнительная комплектация</p>
                </div>
                <?php foreach ($additionalValues as $value): ?>
                    <div class="product-description__option">
                        <p class="product-description__subtitle"><b><?= $value->getLabel() ?></b></p>
                        <p class="product-description__subtitle"><?= $value->getText(); ?> <?= $value->getUnit() ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif ?>
    </div>
<?php endif ?>
