<?php

use kartik\file\FileInput;
use kartik\form\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var \yii\web\View $this
 * @var \app\modules\slide\models\Slide $slide
 */

?>

<?php $form = ActiveForm::begin() ?>
<div class="row">
    <div class="col-xs-8">
        <?= $form->field($slide, 'is_active')->dropDownList([0 => 'Неактивный', 1 => 'Активный']); ?>
        <?= $form->field($slide, 'title')->textarea(['rows' => 3, 'cols' => 5]); ?>
        <?= $form->field($slide, 'position'); ?>
        <?= $form->field($slide, 'link_href'); ?>
        <?= $form->field($slide, 'link_text'); ?>
        <?= $form->field($slide, 'link_is_blank')->dropDownList([0 => 'Не переходит на след. страницу', 1 => 'Переходит на след. страницу']); ?>
        <?= $form->field($slide, 'active_from'); ?>
        <?= $form->field($slide, 'active_to'); ?>
    </div>
    <div class="col-xs-4">
        <div class="single-kartik-image">
            <?= $form->field($slide, 'image')->widget(FileInput::class, [
                'pluginOptions' => [
                    'fileActionSettings' => [
                        'showDrag' => false,
                        'showZoom' => true,
                        'showUpload' => false,
                        'showDelete' => false,
                        'showDownload' => true,
                    ],
                    'initialPreviewDownloadUrl' => $slide->getUploadedFileUrl('image'),
                    'deleteUrl' => Url::to(['delete-image', 'id' => $slide->id, 'key' => 'image']),
                    'showCaption' => false,
                    'showRemove' => false,
                    'showUpload' => false,
                    'showClose' => false,
                    'showCancel' => false,
                    'browseClass' => 'btn btn-primary btn-block',
                    'browseIcon' => '<i class="glyphicon glyphicon-download-alt"></i>',
                    'browseLabel' => 'Выберите файл',
                    'initialPreview' => [
                        $slide->hasImage() ? $slide->getImageFileUrl('image') : null,
                    ],
                    'initialPreviewConfig' => [
                        $slide->hasImage() ? [
                            'caption' => $slide->image,
                            'size' => filesize($slide->getUploadedFilePath('image')),
                            'downloadUrl' => $slide->getImageFileUrl('image'),
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
