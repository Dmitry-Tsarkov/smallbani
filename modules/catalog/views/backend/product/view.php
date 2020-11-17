<?php

use app\modules\catalog\forms\ClientPhotosForm;
use app\modules\catalog\forms\DrawingsForm;
use app\modules\catalog\forms\PhotosForm;
use app\modules\catalog\models\ClientPhoto;
use app\modules\catalog\models\Product;
use app\modules\catalog\models\ProductDrawing;
use app\modules\catalog\models\ProductImage;
use app\modules\characteristic\models\Value;
use kartik\file\FileInput;
use kartik\grid\ActionColumn;
use kartik\grid\DataColumn;
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\DetailView;

/**
 * @var View $this
 * @var Product $product
 * @var PhotosForm $photosForm
 * @var
 */

$this->title = $product->title;
$this->params['breadcrumbs'] = [
    ['label' => 'Товары', 'url' => ['index']],
    $product->title,
];

?>
<?php $this->beginContent('@app/modules/catalog/views/backend/product/layout.php', compact('product')) ?>

<p>
    <?= Html::a('Редактировать', ['update', 'id' => $product->id], ['class' => 'btn btn-primary btn-sm']) ?>
    <?= Html::a('Удалить', ['delete', 'id' => $product->id], ['class' => 'btn btn-danger btn-sm', 'data-method' => 'POST']) ?>
</p>

<p>
    <?php if ($product->status == 1): ?>
        <?= Html::a('Активность', ['draft', 'id' => $product->id], ['class' => 'btn btn-success btn-xs']) ?>
    <?php else: ?>
        <?= Html::a('Активность', ['activate', 'id' => $product->id], ['class' => 'btn btn-default btn-xs']) ?>
    <?php endif ?>

    <?php if ($product->is_popular): ?>
        <?= Html::a('Популярность', ['usual', 'id' => $product->id], ['class' => 'btn btn-success btn-xs']) ?>
    <?php else: ?>
        <?= Html::a('Популярность', ['popular', 'id' => $product->id], ['class' => 'btn btn-default btn-xs']) ?>
    <?php endif ?>
</p>

<div class="row">
    <div class="col-lg-6">
        <div class="box box-default box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Общее</h3>
            </div>
            <?= DetailView::widget([
                'model' => $product,
                'attributes' => [
                    'id',
                    [
                        'label' => 'Статус',
                        'format' => 'raw',
                        'value' => $product->status ? '<span class="label label-success" data-test="123">Активен</span>' : '<span class="label label-danger">Черновик</span>',
                    ],
                    [
                        'label' => 'Популярный товар',
                        'format' => 'raw',
                        'value' => $product->is_popular ? '<span class="label label-success" data-test="123">Популярный</span>' : '<span class="label label-info">Обычный</span>',
                    ],

                    'title',
                    'alias',
                    'gift:ntext',
                    [
                        'label' => 'Категория',
                        'value' => $product->category->title ?? '-',
                    ],
                    [
                        'label' => 'Дата создания',
                        'value' => date('d.m.Y H:i', $product->created_at)
                    ],
                    [
                        'label' => 'Дата редактирования',
                        'value' => date('d.m.Y H:i', $product->updated_at)
                    ],
                ],
            ]); ?>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="box box-default box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Цвета</h3>
            </div>
            <div class="box-body">
                <p>
                    <?= Html::a('Добавить категорию цвета', ['/catalog/backend/product/add-colour-group', 'product_id' => $product->id], ['class' => 'btn btn-success', 'data-pjax' => '0']) ?>
                </p>
                <?= GridView::widget([
                    'dataProvider' => new ArrayDataProvider(['models' => $product->colourGroups]),
                    'summaryOptions' => ['class' => 'text-right'],
                    'bordered' => false,
                    'pjax' => true,
                    'layout' => "{items}",
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
                        'title',
                        [
                            'class' => ActionColumn::className(),
                            'template' => '{update} {delete}',
                            'buttons' => [
                                'update' => function ($url, $model, $key) {;
                                    return Html::a('<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Редактировать',
                                        [
                                            '/catalog/backend/product/update-colour-group', 'id' => $model->id
                                        ],
                                        [
                                            'class' => 'btn btn-primary btn-xs', 'data-pjax' => '0'
                                        ]);
                                },
                                'delete' => function ($url, $model, $key) {;
                                    return Html::a('<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Удалить',
                                        [
                                            '/catalog/backend/product/delete-colour-group',
                                            'id' => $model->id
                                        ],
                                        [
                                            'class' => 'btn btn-primary btn-xs',
                                            'data-pjax' => '0',
                                            'data-method' => 'post',
                                            'data-confirm' => 'Вы уверены?'
                                        ]);
                                },
                            ],
                        ],
                    ]
                ]) ?>
            </div>
        </div>
    </div>
</div>

<div class="box box-default box-solid" id="test-values">
    <div class="box-header with-border">
        <h3 class="box-title">Значения</h3>
    </div>
    <div class="box-body">
        <p>
            <?= Html::a('Добавить значение', ['/catalog/backend/value/request', 'id' => $product->id], ['class' => 'btn btn-success', 'data-pjax' => '0']) ?>
        </p>
        <?= GridView::widget([
            'dataProvider' => new ArrayDataProvider(['models' => $product->values]),
            'summaryOptions' => ['class' => 'text-right'],
            'bordered' => false,
            'pjax' => true,
            'pjaxSettings' => [
                'options' => [
                    'id' => 'pjax-values'
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
                    'label' => 'Характеристика',
                    'value' => function(Value $value) {
                        return $value->characteristic->title;
                    }
                ],
                [
                    'label' => 'Значение',
                    'value' => function(Value $value) {
                        return $value->getText();
                    }
                ],
                [
                    'label' => 'Комплектация',
                    'value' => function(Value $value) {
                        return $value->is_basic_set ? 'Базовая' : 'Дополнительная';
                    }
                ],

                [
                    'class' => ActionColumn::className(),
                    'template' => '{update} {delete}',
                    'noWrap' => true,
                    'buttons' => [
                        'update' => function ($url, Value $model, $key) {
                            return Html::a(
                                '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Редактировать',
                                ['/catalog/backend/value/set', 'id' => $model->product_id, 'characteristicId' => $model->characteristic_id],
                                ['class' => 'btn btn-primary btn-xs', 'data-pjax' => '0']);
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::a('<i class="fa fa-trash" aria-hidden="true"></i>', [
                                '/catalog/backend/value/delete',
                                'productId' => $model->product_id,
                                'valueId' => $model->id,

                            ], [
                                'class' => 'btn btn-danger btn-xs pjax-action',
                                'data-pjax' => '0',
                                'data-confirm' => 'Вы уверены?',
                                'data-method' => 'post',
                                'data-pjax-container' => 'pjax-values'
                            ]);
                        },
                    ],
                ],
            ]
        ]);
        ?>
    </div>
</div>


<div class="box box-default box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Описание</h3>
    </div>
    <div class="box-body">
        <?= $product->description ?>
    </div>
</div>

<div class="box box-default box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Фото</h3>
    </div>
    <div class="box-body">
        <?= FileInput::widget([
            'model' => new PhotosForm(),
            'attribute' => 'files[]',
            'pluginOptions' => [
                'uploadUrl' => Url::to(['/catalog/backend/product/upload', 'id' => $product->id]),
                'initialPreview' => array_map(function(ProductImage $image){
                    return $image->getUploadedFileUrl('image');
                }, $product->images),
                'initialPreviewConfig' => array_map(function(ProductImage $image){
                    return [
                        'key' => $image->id,
                        'caption' => $image->image,
                        'size' => filesize($image->getUploadedFilePath('image')),
                        'downloadUrl' => $image->getImageFileUrl('image'),
                        'url' => Url::to(['/catalog/backend/product/delete-image', 'id' => $image->product_id, 'photoId' => $image->id]),
                    ];
                }, $product->images),
                'initialPreviewAsData' => true,
                'overwriteInitial' => false,
                'showClose' => false,
                'browseClass' => 'btn btn-primary text-right',
                'browseIcon' => '<i class="glyphicon glyphicon-download-alt"></i>',
                'browseLabel' =>  'Выберите файл',
            ],
            'pluginEvents' => [
                'filesorted' => 'function(event, params) {
            console.log(params);
            $.post("' . Url::to(['/catalog/backend/product/sort-images', 'id' => $product->id]) . '",
                params,
            )
        }',
            ],
            'options' => [
                'multiple' => true,
            ],
        ]) ?>
    </div>
</div>

<div class="box box-default box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Чертежи</h3>
    </div>
    <div class="box-body">
        <?= FileInput::widget([
            'model' => new DrawingsForm(),
            'attribute' => 'files[]',
            'pluginOptions' => [
                'uploadUrl' => Url::to(['/catalog/backend/product/upload-drawings', 'id' => $product->id]),
                'initialPreview' => array_map(function(ProductDrawing $drawing){
                    return $drawing->getUploadedFileUrl('image');
                }, $product->drawings),
                'initialPreviewConfig' => array_map(function(ProductDrawing $drawing){
                    return [
                        'key' => $drawing->id,
                        'caption' => $drawing->image,
                        'size' => filesize($drawing->getUploadedFilePath('image')),
                        'downloadUrl' => $drawing->getImageFileUrl('image'),
                        'url' => Url::to(['/catalog/backend/product/delete-drawing', 'id' => $drawing->product_id, 'drawingId' => $drawing->id]),
                    ];
                }, $product->drawings),
                'initialPreviewAsData' => true,
                'overwriteInitial' => false,
                'showClose' => false,
                'browseClass' => 'btn btn-primary text-right',
                'browseIcon' => '<i class="glyphicon glyphicon-download-alt"></i>',
                'browseLabel' =>  'Выберите файл',
            ],
            'pluginEvents' => [
                'filesorted' => 'function(event, params) {
            console.log(params);
            $.post("' . Url::to(['/catalog/backend/product/sort-drawings', 'id' => $product->id]) . '",
                params,
            )
        }',
            ],
            'options' => [
                'multiple' => true,
            ],
        ]) ?>
    </div>
</div>

<div class="box box-default box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Фотографии с клиентами</h3>
    </div>
    <div class="box-body">
        <?= FileInput::widget([
            'model' => new ClientPhotosForm(),
            'attribute' => 'files[]',
            'pluginOptions' => [
                'uploadUrl' => Url::to(['/catalog/backend/product/upload-client-photo', 'id' => $product->id]),
                'initialPreview' => array_map(function(ClientPhoto $client){
                    return $client->getUploadedFileUrl('image');
                }, $product->clientPhotos),
                'initialPreviewConfig' => array_map(function(ClientPhoto $client){
                    return [
                        'key' => $client->id,
                        'caption' => $client->image,
                        'size' => filesize($client->getUploadedFilePath('image')),
                        'downloadUrl' => $client->getImageFileUrl('image'),
                        'url' => Url::to(['/catalog/backend/product/delete-client-photo', 'id' => $client->product_id, 'photoId' => $client->id]),
                    ];
                }, $product->clientPhotos),
                'initialPreviewAsData' => true,
                'overwriteInitial' => false,
                'showClose' => false,
                'browseClass' => 'btn btn-primary text-right',
                'browseIcon' => '<i class="glyphicon glyphicon-download-alt"></i>',
                'browseLabel' =>  'Выберите файл',
            ],
            'pluginEvents' => [
                'filesorted' => 'function(event, params) {
            console.log(params);
            $.post("' . Url::to(['/catalog/backend/product/sort-client-photos', 'id' => $product->id]) . '",
                params,
            )
        }',
            ],
            'options' => [
                'multiple' => true,
            ],
        ]) ?>
    </div>
</div>

<div class="box box-default box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">SEO</h3>
    </div>
    <div class="box-body">
        <?= DetailView::widget([
            'model' => $product,
            'attributes' => [
                [
                    'label' => 'H1',
                    'value' => $product->getSeo()->getH1(),
                ],
                [
                    'label' => 'Заголовок',
                    'value' => $product->getSeo()->getTitle(),
                ],
                [
                    'label' => 'Описание',
                    'value' => $product->getSeo()->getDescription(),
                ],
                [
                    'label' => 'Ключевые слова',
                    'value' => $product->getSeo()->getKeywords(),
                ],
            ],
        ]); ?>
    </div>
</div>

<?php $this->endContent() ?>

