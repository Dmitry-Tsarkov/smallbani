<?php

/**
 * @var \yii\web\View $this
 * @var \app\modules\portfolio\models\Portfolio $portfolio
 * @var \app\modules\portfolio\forms\PortfolioUpdateForm $updateForm
 */

use kartik\form\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;

$this->title = 'Редактирование портфолио: ' . $portfolio->title;
$this->params['breadcrumbs'] = [
    ['label' => 'Портфолио', 'url' => ['index']],
    ['label' => $portfolio->title, 'url' => ['view', 'id' => $portfolio->id]],
    'Редактирование',
];
?>


        <?php $form = ActiveForm::begin() ?>

        <div class="box box-default box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Общее</h3>
            </div>
            <div class="box-body">
                <?= $form->field($updateForm, 'title') ?>
                <?= $form->field($updateForm, 'alias') ?>
                <?= $form->field($updateForm, 'youtube_url') ?>
                <?= $form->field($updateForm, 'description')->widget(CKEditor::class); ?>
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

