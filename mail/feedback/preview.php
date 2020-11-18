<?php

use yii\helpers\Html;

/**
 * @var \yii\web\View $this
 * @var \app\modules\feedback\models\Feedback $feedback
 */

?>

Перезвонить<br>
<br>
Имя: <?= Html::encode($feedback->name) ?><br>
Телефон: <?= Html::encode($feedback->phone) ?><br>
<?php if ($feedback->product_title): ?>
    Товар: <?= Html::encode($feedback->product_title) ?><br>
<?php endif ?>

<?php if ($feedback->portfolio_title): ?>
    Портфолио: <?= Html::encode($feedback->portfolio_title) ?><br>
<?php endif ?>

