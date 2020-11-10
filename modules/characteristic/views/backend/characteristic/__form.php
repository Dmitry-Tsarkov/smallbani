<?php


use kartik\form\ActiveForm;
use yii\bootstrap\Tabs;
use yii\helpers\Html;

/**
 * @var \yii\web\View $this
 * @var \app\modules\characteristic\forms\CharacteristicCreateForm $createForm
 */

?>

<?php $form = ActiveForm::begin() ?>

<div class="row">
    <div class="col-xs-8">
        <?= $form->field($createForm, 'title'); ?>
        <?= $form->field($createForm, 'unit'); ?>
        <?= $form->field($createForm, 'type')->dropDownList($createForm->getTypesDropDown(), ['prompt' => '-- Выберете способ ввода --']); ?>
    </div>
</div>

<?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end() ?>



