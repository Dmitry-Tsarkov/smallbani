<?php


/**
 * @var \yii\web\View $this
 * @var \app\modules\faq\models\Question $question
 */

$this->title = 'Добавление вопрос-ответа';
$this->params['breadcrumbs'] = [
    ['label' => 'Вопрос-ответ', 'url' => ['/faq/backend/question/index']],
    $this->title,
];

?>
<div class="box box-default">
    <div class="box-body">
        <?= $this->render('_form', compact('question')) ?>
    </div>
</div>