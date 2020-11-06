<?php

/**
 * @var \yii\web\View $this
 * @var \app\modules\order\models\Order $order
 */

?>

Заказ с сайта

Имя: <?= $order->name ?><br>
Телефон: <?= $order->phone ?><br>
Товар: <?= $order->product_title ?><br>
<?php foreach ($order->orderModifications as $orderModification): ?>
    <?= $orderModification->modification_title ?> - <?= $orderModification->modification_colour_title ?><br>
<?php endforeach ?>
