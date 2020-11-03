<?php

use app\modules\catalog\forms\PhotosForm;
use app\modules\portfolio\models\Portfolio;
use app\modules\review\models\Review;
use app\modules\review\models\ReviewSearch;
use kartik\grid\ActionColumn;
use kartik\grid\DataColumn;
use kartik\grid\GridView;
use kartik\icons\Icon;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var ActiveDataProvider $dataProvider
 * @var ReviewSearch $searchModel
 * @var Portfolio $portfolio
 * @var PhotosForm $photosForm
 */

$this->title = $portfolio->title;
$this->params['breadcrumbs'] = [
    ['label' => 'Портфолио', 'url' => ['/portfolio/backend/portfolio/index']],
    ['label' => $portfolio->title, 'url' => ['/portfolio/backend/portfolio/view', 'id' => $portfolio->id]],
    'Отзывы',
];

?>
<?php $this->beginContent('@app/modules/portfolio/views/backend/portfolio/layout.php', compact('portfolio')) ?>

<p><?= Html::a('Добавить отзыв', ['/portfolio/backend/review/create', 'portfolioId' => $portfolio->id ], ['class' => 'btn btn-success', 'data-pjax' => '0']) ?></p>

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
    'panel' => false,
    'export' => false,
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
            'value' => function(Review $review) {
                return $review->hasImage() ? '<img src="' . $review->getThumbFileUrl('image') . '">' : '';
            }
        ],
        'name',
        'place',
        'review',
        [
            'class' => DataColumn::class,
            'vAlign' => GridView::ALIGN_MIDDLE,
            'hAlign' => GridView::ALIGN_CENTER,
            'attribute' => 'status',
            'filter' => [0 => 'Нет', 1 => 'Да'],
            'value' => function(Review $review) {
                return $review->status ? '<span class="label label-success">Активный</span>' : '<span class="label label-danger">Неактивный</span>';
            },
            'format' => 'raw',
            'width' => '70px',
        ],
        [
            'class' => ActionColumn::className(),
            'template' => '{update} {delete}',
            'noWrap' => true,
            'buttons' => [
                'update' => function ($url, Review $model, $key) {
                    return Html::a(
                        '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Редактировать',
                        ['/portfolio/backend/review/update', 'portfolioId' => $model->portfolio_id, 'reviewId' => $model->id ],
                        ['class' => 'btn btn-primary btn-xs', 'data-pjax' => '0']
                    );
                },
                'delete' => function ($url, $model, $key) {
                    return Html::a('<i class="fa fa-trash" aria-hidden="true"></i>', [
                        '/catalog/backend/review/delete',
                        'portfolioId' => $model->portfolio_id,
                        'reviewId' => $model->id,
                        'status' => $model->status,
                    ],
                        ['class' => 'btn btn-danger btn-xs', 'data-pjax' => '0', 'data-confirm' => 'Вы уверены?', 'data-method' => 'post']);
                },
            ],
        ],
    ]
]);

$this->endContent();
