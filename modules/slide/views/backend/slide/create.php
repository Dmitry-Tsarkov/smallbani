<?php


/**
 * @var \yii\web\View $this
 * @var \app\modules\slide\models\Slide $slide
 */

$this->title = 'Добавление нового слайда';
$this->params['breadcrumbs'] = [
    ['label' => 'Слайды', 'url' => ['/slide/backend/slide/index']],
    $this->title,
];

?>
<div class="box box-default">
    <div class="box-body">
        <?= $this->render('_form', compact('slide')) ?>
    </div>
</div>
