<?php

use app\modules\catalog\forms\ColourGroupForm;
use app\modules\catalog\models\Product;

/**
 * @var \yii\web\View $this
 * @var ColourGroupForm $groupForm
 * @var Product $product
 * @var \app\modules\catalog\models\ColourGroup $group
 */

$this->title = 'Редактирование категории цвета: ' . $group->title;
$this->params['breadcrumbs'] = [
    ['label' => 'Товары', 'url' => ['/catalog/backend/product/index']],
    ['label' => $product->title, 'url' => ['/catalog/backend/product/view','id' => $product->id]],
    $this->title,
];

?>

<?= $this->render('_form', compact('groupForm')) ?>


