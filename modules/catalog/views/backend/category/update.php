<?php

use kartik\file\FileInput;
use kartik\form\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var \yii\web\View $this
 * @var \app\modules\catalog\models\Category $category
 */

$this->title = 'Редактирование категории: ' . $category->title;
$this->params['breadcrumbs'] = [
    ['label' => 'Категории', 'url' => ['index']],
    $this->title,
];

?>

<p><?= Html::a('Удалить', ['delete', 'id' => $category->id], ['class' => 'btn btn-danger btn-sm']) ?></p>

<div class="box box-default">
    <div class="box-body">
        <?php $form = ActiveForm::begin() ?>
        <div class="row">
            <div class="col-xs-8">
                <?= $form->field($category, 'title') ?>

                <?= $form->field($category, 'alias') ?>
                <?= $form->field($category, 'status')->dropDownList([0 => 'Нет', 1 => 'Да']) ?>
            </div>
            <div class="col-xs-4">
                <div class="single-kartik-image">
                    <?= $form->field($category, 'image')->widget(FileInput::class, [
                        'pluginOptions' => [
                            'fileActionSettings' => [
                                'showDrag' => false,
                                'showZoom' => true,
                                'showUpload' => false,
                                'showDelete' => false,
                                'showDownload' => true,
                            ],
                            'initialPreviewDownloadUrl' => $category->getUploadedFileUrl('image'),
                            'deleteUrl' => Url::to(['delete-image', 'id' => $category->id, 'key' => 'image']),
                            'showCaption' => false,
                            'showRemove' => false,
                            'showUpload' => false,
                            'showClose' => false,
                            'showCancel' => false,
                            'browseClass' => 'btn btn-primary btn-block',
                            'browseIcon' => '<i class="glyphicon glyphicon-download-alt"></i>',
                            'browseLabel' => 'Выберите файл',
                            'initialPreview' => [
                                $category->hasImage() ? $category->getImageFileUrl('image') : null,
                            ],
                            'initialPreviewConfig' => [
                                $category->hasImage() ? [
                                    'caption' => $category->image,
                                    'size' => filesize($category->getUploadedFilePath('image')),
                                    'downloadUrl' => $category->getImageFileUrl('image'),
                                ] : [],
                            ],
                            'initialPreviewAsData' => true,
                        ],
                        'options' => ['accept' => 'image/*'],
                    ]) ?>
                </div>
            </div>
        </div>


        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        <?php ActiveForm::end() ?>
    </div>
</div>


