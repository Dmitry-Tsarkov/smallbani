<?php

use app\modules\catalog\models\ProductSearch;
use app\modules\order\helpers\OrderHelper;
use app\modules\order\models\Order;
use kartik\grid\ActionColumn;
use kartik\grid\DataColumn;
use kartik\grid\GridView;
use kartik\icons\Icon;
use yii\data\DataProviderInterface;
use yii\helpers\Html;
use yii\web\View;


/**
 * @var View $this
 * @var DataProviderInterface $dataProvider
 * @var \app\modules\order\models\OrderSearch $searchModel
 */

$this->title = 'Заказы';
$this->params['breadcrumbs'] = [
    'Заказы',
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
        'name',
        'phone',
        [
            'class' => DataColumn::class,
            'vAlign' => GridView::ALIGN_MIDDLE,
            'hAlign' => GridView::ALIGN_CENTER,
            'attribute' => 'product_id',
            'format' => 'raw',
            'width' => '70px',
        ],
        'product_title',
        [
            'class' => DataColumn::class,
            'vAlign' => GridView::ALIGN_MIDDLE,
            'hAlign' => GridView::ALIGN_CENTER,
            'attribute' => 'status',
            'filter' => $searchModel->getStatusesDropDown(),
            'value' => function(Order $order) {
                return OrderHelper::statusLabelHtml($order->status);
            },
            'format' => 'raw',
            'width' => '150px',
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
