<?php

/* @var $this \yii\web\View
 * @var \app\modules\feedback\models\Feedback $feedback
 */


$this->title = $feedback->name;
$this->params['breadcrumbs'] = [
    ['label' => 'Заявки', 'url' => ['index']],
    $feedback->name,
];


?>

<div class="box box-default box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Цвета</h3>
    </div>
    <div class="box-body">
        <?= $this->render('_detail', compact('feedback')) ?>
    </div>
</div>



