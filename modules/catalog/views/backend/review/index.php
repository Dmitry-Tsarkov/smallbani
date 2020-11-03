<?php

use app\modules\catalog\forms\PhotosForm;
use app\modules\catalog\models\Product;
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
 * @var Product $product
 * @var PhotosForm $photosForm
 */

$this->title = $product->title;
$this->params['breadcrumbs'] = [
    ['label' => 'Товары', 'url' => ['/catalog/backend/product/index']],
    ['label' => $product->title, 'url' => ['/catalog/backend/product/view', 'id' => $product->id]],
    'Отзывы',
];

?>
<?php $this->beginContent('@app/modules/catalog/views/backend/product/layout.php', compact('product')) ?>

<p>
    <?= Html::a('Добавить отзыв', ['/catalog/backend/review/create', 'productId' => $product->id ], ['class' => 'btn btn-success', 'data-pjax' => '0']) ?>
</p>

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
                return $review->status ? '<span class="label label-success" data-test="123">Активный</span>' : '<span class="label label-danger">Неактивный</span>';
            },
            'format' => 'raw',
            'width' => '70px',
        ],
        [
            'class' => ActionColumn::className(),
            'template' => '{update} {delete}',
            'noWrap' => true,
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    return Html::a('<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Редактировать',['/catalog/backend/review/update', 'productId' => $model->product_id, 'reviewId' => $model->id ], ['class' => 'btn btn-primary btn-xs', 'data-pjax' => '0']);
                },
                'delete' => function ($url, $model, $key) {
                    return Html::a('<i class="fa fa-trash" aria-hidden="true"></i>', [
                        '/catalog/backend/review/delete',
                        'productId' => $model->product_id,
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
