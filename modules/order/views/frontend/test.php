<?php

use app\modules\order\forms\OrderForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var $this \yii\web\View
 * @var OrderForm $orderForm
 * @var \app\modules\catalog\models\Product $product
 */

?>

<?php $form = ActiveForm::begin([
    'action' => '/order/frontend/order'
]) ?>
<?= Html::activeHiddenInput($orderForm, 'productId', ['value' => $product->id]) ?>
<?= $form->field($orderForm, 'name') ?>
<?= $form->field($orderForm, 'phone') ?>

<?php foreach ($product->colourGroups as $group): ?>
    <div class="product-description__select">
        <p class="product-description__color-text"><?= $group->title ?>: </p>
        <?= $form->field($orderForm, 'modificationIds[' . $group->id . ']')->radioList(ArrayHelper::map($group->modifications, 'id', 'colour.title')) ?>
    </div>
<?php endforeach; ?>
<?= Html::submitButton() ?>
<?php ActiveForm::end() ?>
