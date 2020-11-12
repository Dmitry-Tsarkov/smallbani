<?php

use kartik\form\ActiveForm;

/**
 * @var \yii\web\View $this
 * @var \app\modules\catalog\models\Product $product
 * @var \app\modules\catalog\forms\ValueForm $valueForm
 */

$this->title = 'Редактирование значения';
$this->params['breadcrumbs'] = [
    ['label' => 'Товары', 'url' => ['/catalog/backend/product/index']],
    ['label' => $product->title, 'url' => ['/catalog/backend/product/view', 'id' => $product->id]],
    'Редактирование значения',
];

?>

<div class="box box-default box-solid">
    <div class="box-body">
        <?php $form = ActiveForm::begin() ?>
        <?php if ($valueForm->isDropDown()): ?>
            <?= $form->field($valueForm, 'value')->dropDownList($valueForm->getVariantsDropDown())->label($valueForm->getLabel()) ?>
        <?php else: ?>
            <?= $form->field($valueForm, 'value')->label($valueForm->getLabel()) ?>
        <?php endif; ?>
        <?= $form->field($valueForm, 'isMain')->checkbox() ?>
        <?= \yii\helpers\Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
</div>

<?php ActiveForm::end() ?>

