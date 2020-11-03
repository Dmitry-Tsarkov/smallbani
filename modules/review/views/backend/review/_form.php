<?php

use kartik\file\FileInput;
use kartik\form\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var \yii\web\View $this
 * @var \app\modules\review\models\Review $review
 * @var \app\modules\review\forms\ReviewForm $reviewForm
 *
 *
 */

?>

<?php $form = ActiveForm::begin() ?>
<div class="row">
    <div class="col-xs-8">
        <?= $form->field($reviewForm, 'status')->dropDownList([0 => 'Неактивный', 1 => 'Активный']); ?>
        <?= $form->field($reviewForm, 'name'); ?>
        <?= $form->field($reviewForm, 'place'); ?>
        <?= $form->field($reviewForm, 'review')->textarea(['rows'=>8]); ?>
    </div>
    <div class="col-xs-4">
        <div class="single-kartik-image">
            <?= $form->field($reviewForm, 'image')->widget(FileInput::class, [
                'pluginOptions' => [
                    'fileActionSettings' => [
                        'showDrag' => false,
                        'showZoom' => true,
                        'showUpload' => false,
                        'showDelete' => false,
                        'showDownload' => true,
                    ],
                    'initialPreviewDownloadUrl' => $review->getUploadedFileUrl('image'),
                    'deleteUrl' => Url::to(['delete-image', 'id' => $review->id, 'key' => 'image']),
                    'showCaption' => false,
                    'showRemove' => false,
                    'showUpload' => false,
                    'showClose' => false,
                    'showCancel' => false,
                    'browseClass' => 'btn btn-primary btn-block',
                    'browseIcon' => '<i class="glyphicon glyphicon-download-alt"></i>',
                    'browseLabel' => 'Выберите файл',
                    'initialPreview' => [
                        $review->hasImage() ? $review->getImageFileUrl('image') : null,
                    ],
                    'initialPreviewConfig' => [
                        $review->hasImage() ? [
                            'caption' => $review->image,
                            'size' => filesize($review->getUploadedFilePath('image')),
                            'downloadUrl' => $review->getImageFileUrl('image'),
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
