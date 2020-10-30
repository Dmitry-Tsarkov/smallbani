<?php

use app\modules\catalog\models\Product;
use kartik\grid\DataColumn;
use kartik\grid\GridView;
use kartik\icons\Icon;
use yii\data\DataProviderInterface;
use yii\grid\ActionColumn;
use yii\helpers\Html;
/**
 *  * @var \yii\web\View $this
 * @var DataProviderInterface $dataProvider
 * @var \app\modules\catalog\models\ProductSearch $searchModel
 */

$this->title = 'Товары';
$this->params['breadcrumbs'] = [
    'Товары',
];
?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'summaryOptions' => ['class' => 'text-right'],
    'bordered' => false,
    'pjax' => true,
    'pjaxSettings' => [
        'options' => [
            'id' => 'pjax-widget'
        ],
    ],
    'striped' => false,
    'hover' => true,
    'panel' => [
        'after' => false,
    ],
    'toolbar' => [
        [
            'content' =>
                Html::a('Добавить товар', ['/catalog/backend/product/create'], ['class' => 'btn btn-success', 'data-pjax' => '0']) .
                Html::a(
                    Icon::show('arrow-sync-outline'),
                    ['index'],
                    [
                        'data-pjax' => 0,
                        'class' => 'btn btn-default',
                        'title' => Yii::t('app', 'Reset')
                    ]
                )
        ],
        '{toggleData}',
    ],
    'export' => false,
    'toggleDataOptions' => [
        'all' => [
            'icon' => 'resize-full',
            'label' => 'Показать все',
            'class' => 'btn btn-default',
            'title' => 'Показать все'
        ],
        'page' => [
            'icon' => 'resize-small',
            'label' => 'Страницы',
            'class' => 'btn btn-default',
            'title' => 'Постаничная разбивка'
        ],
    ],
    'columns' => [
       [
            'class' => DataColumn::class,
            'vAlign' => GridView::ALIGN_MIDDLE,
            'hAlign' => GridView::ALIGN_CENTER,
            'attribute' => 'id',
            'format' => 'raw',
            'width' => '70px',
        ],
        [
            'class' => DataColumn::class,
            'attribute' => 'image',
            'format' => 'raw',
            'value' => function(Product $product) {
                return $product->hasMainImage() ? '<img src="' . $product->getMainImagePreview() . '">' : '';
            }
        ],
        'title',
        'alias',
        [
            'class' => DataColumn::class,
            'vAlign' => GridView::ALIGN_MIDDLE,
            'hAlign' => GridView::ALIGN_CENTER,
            'attribute' => 'is_popular',
            'filter' => [0 => 'Нет', 1 => 'Да'],
            'value' => function(Product $product) {
                return $product->is_popular ? '<span class="label label-success" data-test="123">Да</span>' : '<span class="label label-danger">Нет</span>';
            },
            'format' => 'raw',
            'width' => '100px',
        ],
        [
            'class' => DataColumn::class,
            'vAlign' => GridView::ALIGN_MIDDLE,
            'hAlign' => GridView::ALIGN_CENTER,
            'attribute' => 'status',
            'filter' => [0 => 'Нет', 1 => 'Да'],
            'value' => function(Product $product) {
                return $product->status ? '<span class="label label-success" data-test="123">Да</span>' : '<span class="label label-danger">Нет</span>';
            },
            'format' => 'raw',
            'width' => '70px',
        ],
        [
            'class' => DataColumn::class,
            'vAlign' => GridView::ALIGN_MIDDLE,
            'hAlign' => GridView::ALIGN_CENTER,
            'attribute' => 'category_id',
            'filter' => $searchModel->categoriesDropDown(),
            'value' => function(Product $product) {
                return $product->category->title;
            },
            'width' => '200px',
        ],
        [
            'class' => ActionColumn::className(),
            'template' => '{view}',
            'buttons' => [
                'view' => function ($url, $model, $key) {
                    return Html::a('Просмотр', $url, ['class' => 'btn btn-primary btn-xs', 'data-pjax' => '0']);
                },
            ],
        ],
    ]
]) ?>











