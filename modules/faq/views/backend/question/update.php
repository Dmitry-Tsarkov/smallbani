<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;

/**
 * @var \yii\web\View $this
 * @var \app\modules\faq\models\Question $question
 */

$this->title = 'Редактирование ' . $question->question;
$this->params['breadcrumbs'] = [
    ['label' => 'Вопрос-ответ', 'url' => ['index']],
    $question->question,
];

?>

<?php $this->beginContent('@app/modules/faq/views/backend/question/layout.php', compact('question')) ?>

<?= $this->render('_form', compact('question')) ?>

<?php $this->endContent() ?>