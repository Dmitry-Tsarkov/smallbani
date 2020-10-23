<?php

/**
 * @var \yii\web\View $this
 * @var \app\modules\catalog\models\Product $product
 * @var \app\modules\catalog\forms\PortfolioUpdateForm $updateForm
 */

use kartik\form\ActiveForm;
use yii\helpers\Html;

$this->title = 'Редактирование товара: ' . $product->title;
$this->params['breadcrumbs'] = [
    ['label' => 'Товар', 'url' => ['index']],
    ['label' => $product->title, 'url' => ['view', 'id' => $product->id]],
    'Редактирование',
];

?>

<div class="box box-default">
    <div class="box-body">
        <?php $form = ActiveForm::begin() ?>
            <?= $form->field($updateForm, 'title') ?>
            <?= $form->field($updateForm, 'alias') ?>
            <?= $form->field($updateForm, 'description')->textarea(['rows' => 7, 'cols' => 5]); ?>
            <?= $form->field($updateForm, 'categoryId')->dropDownList($updateForm->getCategoriesDropDown(), ['prompt' => '-- Выберете категорию --']) ?>
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        <?php ActiveForm::end() ?>
    </div>
</div>

