<?php

use yii\helpers\Html;

/**
 * @var \yii\web\View $this
 * @var \app\modules\feedback\models\Feedback $feedback
 */

?>

Вопрос c сайта<br>
<br>
Имя: <?= Html::encode($feedback->name) ?><br>
Email: <?= Html::encode($feedback->email) ?><br>
Сообщение:<br>
<?= nl2br(Html::encode($feedback->text)) ?><br>

