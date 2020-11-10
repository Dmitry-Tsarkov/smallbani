<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;

/**
 * @var \yii\web\View $this
 * @var \app\modules\characteristic\models\Characteristic $characteristic
 * @var \app\modules\characteristic\forms\CharacteristicEditForm $editForm
 */

$this->title = 'Редактирование ' . $characteristic->title;
$this->params['breadcrumbs'] = [
    ['label' => 'Характеристики', 'url' => ['/characteristic/backend/characteristic/index']],
    $characteristic->title,
];

?>

<?php $this->beginContent('@app/modules/characteristic/views/backend/characteristic/layout.php', compact('editForm')) ?>

<?php $form = ActiveForm::begin() ?>
<div class="box box-default box-solid">
    <div class="box-body">
        <?= $form->field($editForm, 'title') ?>
        <?= $form->field($editForm, 'unit') ?>
        <?= $form->field($editForm, 'type')->dropDownList($editForm->getTypesDropDown()) ?>
    </div>
</div>

<?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end() ?>

<?php $this->endContent() ?>

