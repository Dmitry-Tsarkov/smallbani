<?php

use app\modules\catalog\models\Product;
use app\modules\review\forms\ReviewForm;
use kartik\file\FileInput;
use kartik\form\ActiveForm;
use yii\helpers\Html;

/**
 * @var \yii\web\View $this
 * @var ReviewForm $createForm
 * @var Product $product
 */


$this->title = $product->title;
$this->params['breadcrumbs'] = [
    ['label' => 'Товары', 'url' => ['/catalog/backend/product/index']],
    ['label' => $product->title, 'url' => ['/catalog/backend/product/view', 'id' => $product->id]],
    'Добавить отзыв',
];

$this->beginContent('@app/modules/catalog/views/backend/product/layout.php', compact('product'))

?>

    <div class="box-body">
        <h2 class="page-header">
            Добавить отзыв
        </h2>
        <?php $form = ActiveForm::begin() ?>
        <div class="row">
            <div class="col-xs-8">
                <?= $form->field($createForm, 'status')->dropDownList([0 => 'Неактивный', 1 => 'Активный']); ?>
                <?= $form->field($createForm, 'name'); ?>
                <?= $form->field($createForm, 'place'); ?>
                <?= $form->field($createForm, 'review')->textarea(['rows'=>8]); ?>
            </div>
            <div class="col-xs-4">
                <div class="single-kartik-image">
                    <?= $form->field($createForm, 'image')->widget(FileInput::class, [
                        'pluginOptions' => [
                            'fileActionSettings' => [
                                'showDrag' => false,
                                'showZoom' => true,
                                'showUpload' => false,
                                'showDelete' => false,
                                'showDownload' => true,
                            ],
                            'showCaption' => false,
                            'showRemove' => false,
                            'showUpload' => false,
                            'showClose' => false,
                            'showCancel' => false,
                            'browseClass' => 'btn btn-primary btn-block',
                            'browseIcon' => '<i class="glyphicon glyphicon-download-alt"></i>',
                            'browseLabel' => 'Выберите файл',
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