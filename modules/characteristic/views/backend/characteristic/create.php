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



<?php $form = ActiveForm::begin() ?>
<div class="box box-default box-solid">
    <div class="box-body">
        <?= $form->field($createForm, 'title'); ?>
        <?= $form->field($createForm, 'unit'); ?>
        <?= $form->field($createForm, 'type')->dropDownList($createForm->getTypesDropDown(), ['prompt' => '-- Выберете способ ввода --']); ?>
    </div>
</div>

<?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end() ?>


