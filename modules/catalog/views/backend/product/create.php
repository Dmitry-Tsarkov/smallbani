<?php

/**
 * @var \yii\web\View $this
 * @var \app\modules\catalog\forms\ProductCreateForm $createForm
 * @var \app\modules\catalog\forms\PhotosForm $photosForm
 */

use kartik\file\FileInput;
use kartik\form\ActiveForm;
use yii\helpers\Html;

$this->title = 'Добавление товара';
$this->params['breadcrumbs'] = [
    ['label' => 'Товары', 'url' => ['/catalog/backend/product/index']],
    'Новый товар',
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
                    <?= $form->field($createForm, 'title') ?>
                    <?= $form->field($createForm, 'alias') ?>
                    <?= $form->field($createForm, 'description')->textarea(['rows' => 7, 'cols' => 5]); ?>
                    <?= $form->field($createForm, 'gift')->textarea(['rows' => 7, 'cols' => 5]); ?>
                    <?= $form->field($createForm, 'categoryId')->dropDownList($createForm->getCategoriesDropDown(), ['prompt' => '-- Выберете категорию --']) ?>
                </div>
            </div>
            <?= $form->field($createForm->photos, 'files[]')->widget(FileInput::class, [
                'options' => ['multiple' => true]
            ]) ?>
            <?= $form->field($createForm->drawings, 'files[]')->widget(FileInput::class, [
                'options' => ['multiple' => true]
            ]) ?>
            <?= $form->field($createForm->client, 'files[]')->widget(FileInput::class, [
                'options' => ['multiple' => true]
            ]) ?>

        <div class="box box-default box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">SEO</h3>
            </div>
            <div class="box-body">
                <?= $form->field($createForm->seo, 'h1') ?>
                <?= $form->field($createForm->seo, 'title') ?>
                <?= $form->field($createForm->seo, 'description')->textarea(['rows' => 5]) ?>
                <?= $form->field($createForm->seo, 'keywords')->hint('Фразы через запятую') ?>
            </div>
        </div>

        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        <?php ActiveForm::end() ?>
    </div>
</div>
