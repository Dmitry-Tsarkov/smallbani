<?php

use app\modules\catalog\forms\PhotosForm;
use app\modules\catalog\models\Product;
use app\modules\catalog\models\ProductImage;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\DetailView;// ВСтавляю код виджета, вместо name указываем модель и атрибут, модель -

/**
 * @var View $this
 * @var Product $product
 * @var PhotosForm $photosForm
 */

$this->title = $product->title;
$this->params['breadcrumbs'] = [
    ['label' => 'Товар', 'url' => ['index']],
    $product->title,
];

?>

<p>
    <?= Html::a('Редактировать', ['update', 'id' => $product->id], ['class' => 'btn btn-primary btn-sm']) ?>
</p>

<div class="row">
    <div class="col-lg-6">
        <div class="box box-default">
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
                    'title',
                    'alias',

                    [
                        'label' => 'Категория',
                        'value' => $product->category->title ?? '-',
                    ],                             // description свойство, как HTML
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
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Характеристики</h3>
            </div>
        </div>
    </div>
</div>

<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Описание</h3>
    </div>
    <div class="box-body">
        <?= $product->description ?>
    </div>
</div>

<?php //foreach($product->images as $image): ?>
<?//= Html::img($image->getImageFileUrl('image')) ?>
<?php //endforeach;?>

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
                    $.post("' . Url::to(['/admin/product/photos/sort', 'id' => $product->id]) . '",
                        params,
                    )
                }',
    ],
    'options' => [
        'multiple' => true,
    ],
]) ?>