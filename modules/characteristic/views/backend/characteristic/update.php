<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;

/**
 * @var \yii\web\View $this
 * @var \app\modules\characteristic\models\Characteristic $characteristic
 * @var \app\modules\characteristic\forms\CharacteristicEditForm $editForm
 */

$this->title = $characteristic->title;
$this->params['breadcrumbs'] = [

    ['label' => 'Характеристики', 'url' => ['/characteristic/backend/characteristic/index']],
    $characteristic->title,
];

?>

<?php $this->beginContent('@app/modules/characteristic/views/backend/characteristic/layout.php', compact('characteristic')) ?>

<?php $form = ActiveForm::begin() ?>

        <?= $form->field($editForm, 'title') ?>
        <?= $form->field($editForm, 'unit') ?>


<?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end() ?>

<?php $this->endContent() ?>

