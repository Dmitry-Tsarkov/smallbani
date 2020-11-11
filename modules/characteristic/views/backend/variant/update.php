<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;

/**
 * @var \yii\web\View $this
 * @var \app\modules\characteristic\models\Characteristic $characteristic
 * @var \app\modules\characteristic\forms\CharacteristicEditForm $updateForm
 */

$this->title = 'Редактирование варианта';
$this->params['breadcrumbs'] = [
    ['label' => 'Характеристики', 'url' => ['/characteristic/backend/characteristic/index']],
    ['label' => $characteristic->title, 'url' => ['/characteristic/backend/characteristic/update', 'id' => $characteristic->id]],
    ['label' => 'Варианты', 'url' => ['/characteristic/backend/variant/index', 'id' => $characteristic->id]],
    $this->title,
];

?>

<?php $form = ActiveForm::begin() ?>
    <div class="box box-default box-solid">
        <div class="box-body">
            <?= $form->field($updateForm, 'value') ?>
        </div>
        <div class="box-footer">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>


<?php ActiveForm::end() ?>
