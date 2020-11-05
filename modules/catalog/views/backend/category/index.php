<?php

use app\modules\admin\helpers\NestedSetsHelper;
use app\modules\catalog\models\Category;
use kartik\grid\DataColumn;
use kartik\grid\GridView;
use kartik\icons\Icon;
use yii\data\DataProviderInterface;
use yii\grid\ActionColumn;
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
                Html::a('Добавить категорию', ['/catalog/backend/category/create'], ['class' => 'btn btn-success', 'data-pjax' => '0']) .
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
            'vAlign' => GridView::ALIGN_MIDDLE,
            'hAlign' => GridView::ALIGN_CENTER,
            'value' => function (Category $category) {
                return
                    Html::a('<span class="glyphicon glyphicon-arrow-up"></span>', ['move-up', 'id' => $category->id], [
                        'class' => 'pjax-action'
                    ]) .
                    Html::a('<span class="glyphicon glyphicon-arrow-down"></span>', ['move-down', 'id' => $category->id], [
                        'class' => 'pjax-action'
                    ]);
            },
            'format' => 'raw',
            'width' => '60px',
        ],
        [
            'class' => DataColumn::class,
            'attribute' => 'image',
            'format' => 'raw',
            'value' => function(Category $category) {
                return $category->hasImage() ? '<img src="' . $category->getThumbFileUrl('image', 'thumb') . '">' : '';
            }
        ],
        [
            'class' => DataColumn::class,
            'attribute' => 'title',
            'format' => 'raw',
            'value' => function(Category $category) {
                return NestedSetsHelper::depthTitle($category->title, $category->depth);
            }
        ],
        'alias',
        [
            'class' => DataColumn::class,
            'attribute' => 'status',
            'label' => 'Статус',
            'filter' => [0 => 'Нет', 1 => 'Да'],
            'format' => 'html',
            'value' => function(Category $category) {
                return $category->status ? '<span class="label label-success" data-test="123">Да</span>' : '<span class="label label-danger">Нет</span>';
            },
        ],
        [
            'class' => ActionColumn::className(),
            'template' => '{update}',
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    return Html::a('Редактировать', $url, ['class' => 'btn btn-primary btn-xs', 'data-pjax' => '0']);
                },
            ],
        ],
    ]
]) ?>
