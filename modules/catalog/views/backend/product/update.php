<?php

/**
 * @var \yii\web\View $this
 * @var \app\modules\catalog\models\Product $product
 * @var \app\modules\catalog\forms\ProductUpdateForm $updateForm
 */

use kartik\form\ActiveForm;
use yii\helpers\Html;

$this->title = 'Редактирование товара: ' . $product->title;
$this->params['breadcrumbs'] = [
    ['label' => 'Товар', 'url' => ['index']],
    $product->title,
];

?>

<?php $this->beginContent('@app/modules/catalog/views/backend/product/layout.php', compact('product')) ?>

<?php $form = ActiveForm::begin() ?>
    <?= $form->field($updateForm, 'title') ?>
    <?= $form->field($updateForm, 'alias') ?>
    <?= $form->field($updateForm, 'description')->textarea(['rows' => 7, 'cols' => 5]); ?>
    <?= $form->field($updateForm, 'categoryId')->dropDownList($updateForm->getCategoriesDropDown(), ['prompt' => '-- Выберете категорию --']) ?>
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end() ?>

<?php $this->endContent() ?>
