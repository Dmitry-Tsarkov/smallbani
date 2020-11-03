<?php



/**
 * @var $this \yii\web\View
 * @var \app\modules\review\models\Review $review
 * @var \app\modules\catalog\models\Product $product
 * @var \app\modules\review\forms\ReviewForm $editForm
 */

use kartik\file\FileInput;
use kartik\form\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $product->title;
$this->params['breadcrumbs'] = [
    ['label' => 'Товары', 'url' => ['/catalog/backend/product/index']],
    ['label' => $product->title, 'url' => ['/catalog/backend/product/view', 'id' => $product->id]],
    'Редактирование',
];

?>

<?php $this->beginContent('@app/modules/catalog/views/backend/product/layout.php', compact('product'))?>
    <div class="box-body">
        <h2 class="page-header">
            Редактирование отзыва
        </h2>
        <?php $form = ActiveForm::begin() ?>
        <div class="row">
            <div class="col-xs-8">
                <?= $form->field($editForm, 'status')->dropDownList([0 => 'Неактивный', 1 => 'Активный']); ?>
                <?= $form->field($editForm, 'name'); ?>
                <?= $form->field($editForm, 'place'); ?>
                <?= $form->field($editForm, 'review')->textarea(['rows'=>8]); ?>
            </div>
            <div class="col-xs-4">
                <div class="single-kartik-image">
                    <?= $form->field($editForm, 'image')->widget(FileInput::class, [
                        'pluginOptions' => [
                            'fileActionSettings' => [
                                'showDrag' => false,
                                'showZoom' => true,
                                'showUpload' => false,
                                'showDelete' => false,
                                'showDownload' => true,
                            ],
                            'initialPreviewDownloadUrl' => $review->getUploadedFileUrl('image'),
                            'deleteUrl' => Url::to(['delete-image', 'productId' => $review->product_id, 'reviewId' => $review->id, 'key' => 'image']),
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
    </div>
<?php $this->endContent();?>




