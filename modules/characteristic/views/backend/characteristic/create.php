<?php

/**
 * @var \yii\web\View $this
 * @var app\modules\characteristic\forms\CharacteristicCreateForm $createForm
 */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

$this->title = 'Добавление новой характеристики';
$this->params['breadcrumbs'] = [
    ['label' => 'Характеристики', 'url' => ['/characteristic/backend/characteristic/index']],
    $this->title,
];

?>

<?php $this->beginContent('@app/modules/characteristic/views/backend/characteristic/layout.php', compact('createForm')) ?>

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

<?php $this->endContent() ?>
