<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;

/**
 * @var \yii\web\View $this
 * @var \app\modules\catalog\models\Category $category
 */

$this->title = 'Добавление категории';
$this->params['breadcrumbs'] = [
    ['label' => 'Категории', 'url' => ['/catalog/backend/category/index']],
    $this->title,
];

?>

<div class="box box-default">
    <div class="box-body">
        <?php $form = ActiveForm::begin() ?>
        <?= $form->field($category, 'title') ?>
        <?= $form->field($category, 'alias') ?>
        <?= $form->field($category, 'status')->dropDownList([0 => 'Неактивный', 1 => 'Активный']) ?>
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        <?php ActiveForm::end() ?>
    </div>
</div>


