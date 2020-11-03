<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;
use kartik\file\FileInput;
use yii\helpers\Url;

/**
 * @var \yii\web\View $this
 * @var app\modules\catalog\models\Category $category;
 */

?>
<?php $form = ActiveForm::begin() ?>
<div class="row">
    <div class="col-xs-8">
        <?= $form->field($category, 'title') ?>
        <?= $form->field($category, 'alias') ?>

    </div>
</div>
<?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end() ?>


