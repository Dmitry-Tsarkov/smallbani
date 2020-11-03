<?php

use app\modules\catalog\forms\PhotosForm;
use app\modules\catalog\models\Category;
use kartik\form\ActiveForm;
use yii\web\View;


/**
 * @var View $this
 * @var Category $category
 * @var PhotosForm $photosForm
 */

$this->title = $category->title;
$this->params['breadcrumbs'] = [
    ['label' => 'Товары', 'url' => ['index']],
    $category->title,
];

?>

<?php $this->beginContent('@app/modules/catalog/views/backend/category/layout.php', compact('category')) ?>

<?php $form = ActiveForm::begin() ?>
<div class="box-body">
    <?= $form->field($category, 'h1') ?>
    <?= $form->field($category, 'meta_t') ?>
    <?= $form->field($category, 'meta_d')->textarea(['rows' => 5]) ?>
    <?= $form->field($category, 'meta_k')->hint('Фразы через запятую') ?>
</div>
<div class="box-footer">
    <button class="btn btn-success">Сохранить</button>
</div>

<?php ActiveForm::end() ?>

<?php $this->endContent() ?>
