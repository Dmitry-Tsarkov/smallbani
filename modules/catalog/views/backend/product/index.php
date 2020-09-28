<?php

use app\modules\catalog\models\Product;
use yii\data\DataProviderInterface;
use yii\grid\DataColumn;
use yii\grid\GridView;
use yii\helpers\Html;

/**
 * @var DataProviderInterface $dataProvider
 * @var \app\modules\catalog\models\ProductSearch $searchModel
 */

$this->title = 'Товары';
$this->params['breadcrumbs'] = [
    'Товары',
];
?>

<p>
    <?= Html::a('Добавить товар', ['/catalog/backend/product/create'], ['class' => 'btn btn-success btn-sm']) ?>
</p>

<h1>Products</h1>

<?= GridView::widget([
    'filterModel' => $searchModel,
    'dataProvider' => $dataProvider,
    'columns' => [

        'id',
        'title',
        'alias',
        [
            'class' => DataColumn::class,
            'attribute' => 'status',
            'label' => 'Статус',
            'filter' => [0 => 'Нет', 1 => 'Да'],
            'format' => 'html',
            'value' => function(Product $product) {
                return $product->status ? '<span class="label label-success" data-test="123">Да</span>' : '<span class="label label-danger">Нет</span>';
            },
        ],
        'category_id',
    ]
]); ?>









