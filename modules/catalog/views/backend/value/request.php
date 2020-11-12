<?php

/* @var $this \yii\web\View
 * @var \app\modules\catalog\models\Product $product
 * @var \app\modules\catalog\forms\RequestValueForm $requestForm
 */

$this->title = 'Добавление значения';
$this->params['breadcrumbs'] = [
    ['label' => 'Товары', 'url' => ['/catalog/backend/product/index']],
    ['label' => $product->title, 'url' => ['/catalog/backend/product/view', 'id' => $product->id]],
    'Добавление значения',
];

use kartik\form\ActiveForm;
use yii\helpers\Html;

?>


<?php $form = ActiveForm::begin() ?>

<div class="box box-default box-solid">
    <div class="box-body">
        <?= $form->field($requestForm, 'characteristic_id')->widget(\kartik\select2\Select2::class, [
            'theme' => \kartik\select2\Select2::THEME_DEFAULT,
            'data' => $requestForm->getCharacteristicDropDown(),
             'options' => [
                 'options' => $requestForm->getDisabledOptions(),
             ]
        ]) ?>
        <?= Html::submitButton('Далее', ['class' => 'btn btn-primary']) ?>
    </div>
</div>

<?php ActiveForm::end() ?>





