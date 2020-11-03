<?php

use kartik\color\ColorInput;
use kartik\file\FileInput;
use kartik\form\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;


/**
 * @var \yii\web\View $this
 * @var \app\modules\colour\models\Colour $colour
 */

?>

<?php $form = ActiveForm::begin() ?>

<div class="row">
    <div class="col-xs-8">
        <?= $form->field($colour, 'title'); ?>
        <?= $form->field($colour, 'hex')->widget(ColorInput::class, [
            'options' => ['placeholder' => 'Select color ...', 'readonly' => true]
        ]) ?>
    </div>
</div>

<?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end() ?>
