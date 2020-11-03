<?php

use app\modules\actions\models\Promo;
use app\modules\catalog\forms\PhotosForm;
use kartik\form\ActiveForm;
use yii\web\View;

/**
 * @var View $this
 * @var Promo $action
 * @var PhotosForm $photosForm
 */

$this->title = $action->title;
$this->params['breadcrumbs'] = [
    ['label' => 'Акции', 'url' => ['index']],
    $action->title,
];

?>

<?php $this->beginContent('@app/modules/actions/views/backend/actions/layout.php', compact('action')) ?>

<?php $form = ActiveForm::begin() ?>
<div class="box-body">
    <?= $form->field($action, 'h1') ?>
    <?= $form->field($action, 'meta_t') ?>
    <?= $form->field($action, 'meta_d')->textarea(['rows' => 5]) ?>
    <?= $form->field($action, 'meta_k')->hint('Фразы через запятую') ?>
</div>
<div class="box-footer">
    <button class="btn btn-success">Сохранить</button>
</div>

<?php ActiveForm::end() ?>

<?php $this->endContent() ?>
