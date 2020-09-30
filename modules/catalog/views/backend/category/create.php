<?php


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
        <?= $this->render('_form', compact('category')) ?>
    </div>
</div>

