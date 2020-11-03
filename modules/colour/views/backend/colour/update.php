<?php

/**
 * @var \yii\web\View $this
 * @var \app\modules\colour\models\Colour $colour
 */

$this->title = 'Редактирование ' . $colour->title;
$this->params['breadcrumbs'] = [
    ['label' => 'Цвета', 'url' => ['index']],
    $colour->title,
];

?>

<div class="box box-default">
    <div class="box-body">
        <?= $this->render('_form', compact('colour')) ?>
    </div>
</div>
