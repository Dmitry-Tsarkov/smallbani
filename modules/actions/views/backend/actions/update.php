<?php

/**
 * @var \yii\web\View $this
 * @var \app\modules\actions\models\Promo $action
 */

$this->title = 'Редактирование ' . $action->title;
$this->params['breadcrumbs'] = [
    ['label' => 'Акции', 'url' => ['index']],
    $action->title,
];

?>

<?php $this->beginContent('@app/modules/actions/views/backend/actions/layout.php', compact('action')) ?>

<?= $this->render('_form', compact('action')) ?>

<?php $this->endContent() ?>
