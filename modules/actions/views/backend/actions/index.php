<?php

use app\modules\actions\models\Promo;
use kartik\grid\DataColumn;
use kartik\grid\GridView;
use kartik\icons\Icon;
use yii\data\DataProviderInterface;
use yii\grid\ActionColumn;
use yii\helpers\Html;
/**
 * @var \yii\web\View $this
 * @var DataProviderInterface $dataProvider
 * @var \app\modules\actions\models\PromoSearch $searchModel
 */

$this->title = 'Акции';
$this->params['breadcrumbs'] = [
    'Акции',
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
                Html::a('Добавить акцию', ['/actions/backend/actions/create'], ['class' => 'btn btn-success', 'data-pjax' => '0']) .
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

        'title',
        'alias',
        [
            'class' => DataColumn::class,
            'attribute' => 'image',
            'format' => 'raw',
            'value' => function(Promo $action) {
                return $action->hasImage() ? '<img src="' . $action->getThumbFileUrl('image', 'thumb') . '">' : '';
            }
        ],
        [
            'class' => DataColumn::class,
            'vAlign' => GridView::ALIGN_MIDDLE,
            'hAlign' => GridView::ALIGN_CENTER,
            'attribute' => 'description',
            'format' => 'raw',
            'width' => '700px',
        ],
        [
            'class' => DataColumn::class,
            'vAlign' => GridView::ALIGN_MIDDLE,
            'hAlign' => GridView::ALIGN_CENTER,
            'attribute' => 'is_relevant',
            'filter' => $searchModel->IsRelevantDropDown(),
            'value' => function(Promo $action) {
                return $action->is_relevant ? '<span class="label label-success" data-test="123">Актуальная</span>' : '<span class="label label-danger">Неактуальная</span>';
            },
            'format' => 'raw',
            'width' => '100px',
        ],
        [
            'class' => DataColumn::class,
            'vAlign' => GridView::ALIGN_MIDDLE,
            'hAlign' => GridView::ALIGN_CENTER,
            'attribute' => 'status',
            'label' => 'Статус',
            'filter' => $searchModel->StatusDropDown(),
            'format' => 'html',
            'value' => function(Promo $action) {
                return $action->status ? '<span class="label label-success" data-test="123">Активная</span>' : '<span class="label label-danger">Неактивная</span>';
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
