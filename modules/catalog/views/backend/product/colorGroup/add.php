<?php


/**
 * @var \yii\web\View $this
 * @var ColourGroupForm $groupForm
 * @var Product $product
 */

use app\modules\catalog\forms\ColourGroupForm;
use app\modules\catalog\models\Product;

$this->title = 'Добавление новой категории цвета';
$this->params['breadcrumbs'] = [
    ['label' => 'Товары', 'url' => ['/catalog/backend/product/index','id' => $product->id]],
    ['label' => $product->title, 'url' => ['/catalog/backend/product/view','id' => $product->id]],
    $this->title,
];

?>

<?= $this->render('_form', compact('groupForm')) ?>

