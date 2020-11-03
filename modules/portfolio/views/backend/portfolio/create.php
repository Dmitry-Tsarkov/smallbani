<?php

/**
 * @var \yii\web\View $this
 * @var \app\modules\portfolio\forms\PortfolioCreateForm $createForm
 * @var \app\modules\portfolio\forms\PhotosForm $photosForm
 */

use kartik\file\FileInput;
use kartik\form\ActiveForm;
use yii\helpers\Html;

$this->title = 'Добавление в портфолио';
$this->params['breadcrumbs'] = [
    ['label' => 'Портфолио', 'url' => ['index']],
    'Добавить',
];

?>

<?php $form = ActiveForm::begin() ?>
    <div class="box box-default box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Общее</h3>
        </div>
        <div class="box-body">
            <?= $form->field($createForm, 'title') ?>
            <?= $form->field($createForm, 'alias') ?>
            <?= $form->field($createForm, 'youtube_url') ?>
            <?= $form->field($createForm, 'description')->textarea(['rows' => 7, 'cols' => 5]); ?>
            <?= $form->field($createForm, 'categoryId')->dropDownList($createForm->getCategoriesDropDown(), ['prompt' => '-- Выберете категорию --']) ?>
            <?= $form->field($createForm->photos, 'files[]')->widget(FileInput::class, [
                'options' => ['multiple' => true]
            ]) ?>
        </div>
    </div>

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

