<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;

/**
 * @var \yii\web\View $this
 * @var \app\modules\faq\models\Question $question
 */

?>

<?php $form = ActiveForm::begin() ?>
    <?= $form->field($question, 'status')->dropDownList([0 => 'Неактивный', 1 => 'Активный']); ?>
    <?= $form->field($question, 'question'); ?>
    <?= $form->field($question, 'answer')->textarea(['rows' => 3, 'cols' => 5]); ?>
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end() ?>