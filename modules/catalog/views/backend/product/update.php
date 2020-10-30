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
    ['label' => $product->title, 'url' => ['view', 'id' => $product->id]],
    'Редактирование',
];

?>

<div class="box box-default">
    <div class="box-body">
        <?php $form = ActiveForm::begin() ?>
            <div class="box box-default box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Общее</h3>
                </div>
                <div class="box-body">
                    <?= $form->field($updateForm, 'title') ?>
                    <?= $form->field($updateForm, 'alias') ?>
                    <?= $form->field($updateForm, 'description')->textarea(['rows' => 7, 'cols' => 5]); ?>
                    <?= $form->field($updateForm, 'gift')->textarea(['rows' => 4, 'cols' => 5]); ?>
                    <?= $form->field($updateForm, 'categoryId')->dropDownList($updateForm->getCategoriesDropDown(), ['prompt' => '-- Выберете категорию --']) ?>
                </div>
            </div>
            <div class="box box-default box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">SEO</h3>
                </div>
                <div class="box-body">
                    <?= $form->field($updateForm->seo, 'h1') ?>
                    <?= $form->field($updateForm->seo, 'title') ?>
                    <?= $form->field($updateForm->seo, 'description')->textarea(['rows' => 5]) ?>
                    <?= $form->field($updateForm->seo, 'keywords')->hint('Фразы через запятую') ?>
                </div>
            </div>
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        <?php ActiveForm::end() ?>
    </div>
</div>

