<?php

/**
 * @var \yii\web\View $this
 * @var \app\modules\slide\models\Slide $slide
 */

$this->title = 'Редактирование ' . $slide->title;
$this->params['breadcrumbs'] = [
    ['label' => 'Слайды', 'url' => ['index']],
    $slide->title,
];

?>

<?php $this->beginContent('@app/modules/slide/views/backend/slide/layout.php', compact('slide')) ?>

<?= $this->render('_form', compact('slide')) ?>

<?php $this->endContent() ?>
