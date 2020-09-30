<?php

/**
 * @var \yii\web\View $this
 * @var \app\modules\catalog\forms\ProductCreateForm $createForm
 */

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
            <?= $form->field($createForm, 'title') ?>
            <?= $form->field($createForm, 'alias') ?>
            <?= $form->field($createForm, 'description')->textarea(['rows' => 7, 'cols' => 5]); ?>
            <?= $form->field($createForm, 'categoryId')->dropDownList($createForm->getCategoriesDropDown(), ['prompt' => '-- Выберете категорию --']) ?>
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        <?php ActiveForm::end() ?>
    </div>
</div>
