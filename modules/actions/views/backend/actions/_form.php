<?php

use kartik\file\FileInput;
use kartik\form\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var \yii\web\View $this
 * @var \app\modules\actions\models\Promo $action
 */

?>

<?php $form = ActiveForm::begin() ?>
<div class="row">
    <div class="col-xs-8">
        <?= $form->field($action, 'status')->dropDownList([0 => 'Неактивный', 1 => 'Активный']); ?>
        <?= $form->field($action, 'title'); ?>
        <?= $form->field($action, 'is_relevant')->dropDownList([0 => 'Неактуальная', 1 => 'Актуальная']);; ?>
        <?= $form->field($action, 'alias'); ?>
        <?= $form->field($action, 'description')->textarea(['rows' => 3, 'cols' => 5]); ?>
    </div>
    <div class="col-xs-4">
        <div class="single-kartik-image">
            <?= $form->field($action, 'image')->widget(FileInput::class, [
                'pluginOptions' => [
                    'fileActionSettings' => [
                        'showDrag' => false,
                        'showZoom' => true,
                        'showUpload' => false,
                        'showDelete' => false,
                        'showDownload' => true,
                    ],
                    'initialPreviewDownloadUrl' => $action->getUploadedFileUrl('image'),
                    'deleteUrl' => Url::to(['delete-image', 'id' => $action->id, 'key' => 'image']),
                    'showCaption' => false,
                    'showRemove' => false,
                    'showUpload' => false,
                    'showClose' => false,
                    'showCancel' => false,
                    'browseClass' => 'btn btn-primary btn-block',
                    'browseIcon' => '<i class="glyphicon glyphicon-download-alt"></i>',
                    'browseLabel' => 'Выберите файл',
                    'initialPreview' => [
                        $action->hasImage() ? $action->getImageFileUrl('image') : null,
                    ],
                    'initialPreviewConfig' => [
                        $action->hasImage() ? [
                            'caption' => $action->image,
                            'size' => filesize($action->getUploadedFilePath('image')),
                            'downloadUrl' => $action->getImageFileUrl('image'),
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
