<?php


/**
 * @var \yii\web\View $this
 * @var \app\modules\colour\models\Colour $colour
 */

$this->title = 'Добавление нового цвета';
$this->params['breadcrumbs'] = [
    ['label' => 'Цвета', 'url' => ['/colour/backend/colour/index']],
    $this->title,
];

?>
<div class="box box-default">
    <div class="box-body">
        <?= $this->render('_form', compact('colour')) ?>
    </div>
</div>
