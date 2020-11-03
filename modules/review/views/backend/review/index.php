<?php


/* @var $this \yii\web\View
 * @var DataProviderInterface $dataProvider
 * @var \app\modules\review\models\ReviewSearch $searchModel
 *
 */

use app\modules\review\models\Review;
use kartik\grid\DataColumn;
use kartik\grid\GridView;
use kartik\icons\Icon;
use yii\data\DataProviderInterface;
use yii\grid\ActionColumn;
use yii\helpers\Html;

$this->title = 'Отзывы';
$this->params['breadcrumbs'] = [
    'Отзывы',
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
                Html::a('Добавить акцию', ['/review/backend/review/create'], ['class' => 'btn btn-success', 'data-pjax' => '0']) .
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
            'attribute' => 'image',
            'format' => 'raw',
            'value' => function(Review $review) {
                return $review->hasImage() ? '<img src="' . $review->getThumbFileUrl('image', 'thumb') . '">' : '';
            }
        ],
        'name',
        'place',
        [
            'class' => DataColumn::class,
            'vAlign' => GridView::ALIGN_MIDDLE,
            'hAlign' => GridView::ALIGN_CENTER,
            'attribute' => 'type',
            'label' => 'Тип отзыва',
            'filter' => $searchModel->TypeDropDown(),
            'format' => 'html',
            'value' => function (Review $review) {
                if ($review->type == '0') {
                    return '<span class="label label-success" data-test="123">Общие отзывы</span>';
                } elseif ($review->type == '1') {
                    return '<span class="label label-success" data-test="123">Отзыв продукта</span>';
                } elseif ($review->type == '2') {
                    return '<span class="label label-success" data-test="123">Отзыв портфолио</span>';
                }
            }

//                return $review->type ? '<span class="label label-success" data-test="123">Отзыв продукта</span>' : '<span class="label label-danger">Отзыв портфолио</span>';

        ],
        [
            'class' => DataColumn::class,
            'attribute' => 'review',
            'format' => 'ntext',
            'width' => '700px',
        ],
        [
            'class' => DataColumn::class,
            'vAlign' => GridView::ALIGN_MIDDLE,
            'hAlign' => GridView::ALIGN_CENTER,
            'attribute' => 'status',
            'label' => 'Статус',
            'filter' => $searchModel->StatusDropDown(),
            'format' => 'html',
            'value' => function(Review $review) {
                return $review->status ? '<span class="label label-success" data-test="123">Активная</span>' : '<span class="label label-danger">Неактивная</span>';
            },
        ],
        [

            'class' => DataColumn::class,
            'attribute' => 'created_at',
            'value' => function(Review  $review){
                return date('d.m.Y H:i',$review->created_at);
            }
        ],
        [
            'class' => ActionColumn::className(),
            'template' => '{update}',
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    return Html::a('редактировать', $url, ['class' => 'btn btn-primary  btn-xs', 'data-pjax' => '0']);
                },
            ],
        ],
    ]
]) ?>
