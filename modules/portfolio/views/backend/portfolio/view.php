<?php

use app\modules\portfolio\forms\PhotosForm;
use app\modules\portfolio\models\PortfolioImage;
use app\modules\portfolio\models\Portfolio;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\DetailView;

/**
 * @var View $this
 * @var Portfolio $portfolio
 * @var PhotosForm $photosForm
 */

$this->title = $portfolio->title;
$this->params['breadcrumbs'] = [
    ['label' => 'Портфолио', 'url' => ['index']],
    $portfolio->title,
];

?>

<?php $this->beginContent('@app/modules/portfolio/views/backend/portfolio/layout.php', compact('portfolio')) ?>

<p>
    <?= Html::a('Редактировать', ['update', 'id' => $portfolio->id], ['class' => 'btn btn-primary btn-sm']) ?>
    <?= Html::a('Удалить', ['delete', 'id' => $portfolio->id], ['class' => 'btn btn-danger btn-sm', 'data-method' => 'POST']) ?>
</p>

<p>
    <?php if ($portfolio->status == 1): ?>
        <?= Html::a('Активность', ['draft', 'id' => $portfolio->id], ['class' => 'btn btn-success btn-xs']) ?>
    <?php else: ?>
        <?= Html::a('Активность', ['activate', 'id' => $portfolio->id], ['class' => 'btn btn-default btn-xs']) ?>
    <?php endif ?>

</p>

<div class="row">
    <div class="col-lg-12">
        <div class="box box-default box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Общее</h3>
            </div>
            <?= DetailView::widget([
                'model' => $portfolio,
                'attributes' => [
                    'id',
                    [
                        'label' => 'Статус',
                        'format' => 'raw',
                        'value' => $portfolio->status ? '<span class="label label-success" data-test="123">Активен</span>' : '<span class="label label-danger">Черновик</span>',
                    ],
                    'title',
                    'alias',
                    'youtube_url',

                    [
                        'label' => 'Категория',
                        'value' => $portfolio->category->title ?? '-',
                    ],
                    [
                        'label' => 'Дата создания',
                        'value' => `date('d.m.Y H:i', $portfolio->created_at)`
                    ],
                    [
                        'label' => 'Дата редактирования',
                        'value' => date('d.m.Y H:i', $portfolio->updated_at)
                    ],
                ],
            ]); ?>
        </div>

        <div class="box box-default box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Описание</h3>
            </div>
            <div class="box-body">
                <?= $portfolio->description ?>
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
                        'uploadUrl' => Url::to(['/portfolio/backend/portfolio/upload', 'id' => $portfolio->id]),
                        'initialPreview' => array_map(function (PortfolioImage $image) {
                            return $image->getUploadedFileUrl('image');
                        }, $portfolio->images),
                        'initialPreviewConfig' => array_map(function (PortfolioImage $image) {
                            return [
                                'key' => $image->id,
                                'caption' => $image->image,
                                'size' => filesize($image->getUploadedFilePath('image')),
                                'downloadUrl' => $image->getImageFileUrl('image'),
                                'url' => Url::to(['/portfolio/backend/portfolio/delete-image', 'id' => $image->portfolio_id, 'photoId' => $image->id]),
                            ];
                        }, $portfolio->images),
                        'initialPreviewAsData' => true,
                        'overwriteInitial' => false,
                        'showClose' => false,
                        'browseClass' => 'btn btn-primary text-right',
                        'browseIcon' => '<i class="glyphicon glyphicon-download-alt"></i>',
                        'browseLabel' => 'Выберите файл',
                    ],
                    'pluginEvents' => [
                        'filesorted' => 'function(event, params) {
            console.log(params);
            $.post("' . Url::to(['/portfolio/backend/portfolio/sort-images', 'id' => $portfolio->id]) . '",
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
        <?php $this->endContent() ?>
