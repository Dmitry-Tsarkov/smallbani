<?php


/**
 * @var \yii\web\View $this
 * @var \app\modules\actions\models\Promo $action
 */

$this->title = 'Добавление новой акции';
$this->params['breadcrumbs'] = [
    ['label' => 'Акции', 'url' => ['/actions/backend/actions/index']],
    $this->title,
];

?>
<div class="box box-default">
    <div class="box-body">
        <?= $this->render('_form', compact('action')) ?>
    </div>
</div>
