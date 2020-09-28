<?php

use app\modules\catalog\models\Category;
use yii\data\DataProviderInterface;
use yii\grid\ActionColumn;
use yii\grid\DataColumn;
use yii\grid\GridView;
use yii\helpers\Html;

/**
 * @var \yii\web\View $this
 * @var DataProviderInterface $dataProvider
 * @var \app\modules\catalog\models\ProductSearch $searchModel
 */

$this->title = 'Категории';
$this->params['breadcrumbs'] = [
    'Категории',
];

?>

<p>
    <?= Html::a('Добавить категорию', ['/catalog/backend/category/create'], ['class' => 'btn btn-success btn-sm']) ?>
</p>

<?= GridView::widget([
    'filterModel' => $searchModel,
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        [
            'class' => DataColumn::class,
            'attribute' => 'image',
            'format' => 'raw',
            'value' => function(Category $category) {
                return '<img src="' . $category->getThumbFileUrl('image', 'thumb', '/images/empty.jpg') . '">';
            }
        ],
        'title',
        'alias',
        [
            'class' => DataColumn::class,
            'attribute' => 'status',
            'label' => 'Статус',
            'filter' => [0 => 'Нет', 1 => 'Да'],
            'format' => 'html',
            'value' => function(Category $category) {
                return $category->status ? '<span class="label label-success" data-test="123">Да</span>' : '<span class="label label-danger">Нет</span>';
                var_dump ($category);
            },
        ],
        [
            'class' => ActionColumn::className(),
            'template' => '{update}',
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    return Html::a('Редактировать', $url, ['class' => 'btn btn-primary btn-xs']);

                },
            ],
        ],
    ]
]); ?>
