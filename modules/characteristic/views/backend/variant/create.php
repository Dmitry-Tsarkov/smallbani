<?php

/**
 * @var \yii\web\View $this
 * @var \app\modules\characteristic\forms\VariantForm $createForm
 * @var \app\modules\characteristic\models\Variant $characteristic
 */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;



$this->title = 'Добавление нового варианта';
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
        <?= $form->field($createForm, 'value'); ?>
    </div>
</div>

<?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end() ?>


