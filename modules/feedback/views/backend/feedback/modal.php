<?php

/* @var $this \yii\web\View
 * @var \app\modules\feedback\models\Feedback $feedback
 */


?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Modal title</h4>
</div>
<div class="modal-body">
    <?= $this->render('_detail', compact('feedback')) ?>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
</div>

