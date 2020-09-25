<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;

/**
 * @var \yii\web\View $this
 * @var \app\modules\catalog\models\Category $category
 */

$this->title = 'Редактирование категории: ' . $category->title;
$this->params['breadcrumbs'] = [
    ['label' => 'Категории', 'url' => ['index']],
    $this->title,
];

?>

<p><?= Html::a('Удалить', ['delete', 'id' => $category->id], ['class' => 'btn btn-danger btn-sm']) ?></p>

<div class="box box-default">
    <div class="box-body">
        <?php $form = ActiveForm::begin() ?>
        <?= $form->field($category, 'title') ?>
        <?= $form->field($category, 'alias') ?>
        <?= $form->field($category, 'status')->dropDownList([0 => 'Нет', 1 => 'Да']) ?>
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        <?php ActiveForm::end() ?>
    </div>
</div>


