<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;


/**
 * @var \yii\web\View $this
 * @var \app\modules\catalog\models\Category $category
 */

$this->title = 'Редактирование ' . $category->title;
$this->params['breadcrumbs'] = [
    ['label' => 'Катекгория', 'url' => ['/catalog/backend/category/index']],
    $category->title,
];

?>

<?php $this->beginContent('@app/modules/catalog/views/backend/category/layout.php', compact('category')) ?>

<?= $this->render('_form', compact('category')) ?>

<?php $this->endContent() ?>


