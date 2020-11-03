<?php

/**
 * @var $this \yii\web\View
 * @var \app\modules\order\models\Order $order
 */

?>

<section class="section error">
    <div class="container">
        <div class="section__body">
            <p style="font-weight: bold; font-size: 40px; line-height: 51px; margin-bottom: 20px">Спасибо! Ваша заявка <br> оформлена</p>
            <p style="font-size: 18px; line-height: 24px; margin-bottom: 20px">Наш менеджер перезвонит вам в течении 15 минут, чтобы <br> уточнить условия заказа и доставки </p><a class="button js-button" area-label="На главную" href="<?= Yii::$app->homeUrl ?>">На главную</a>
        </div>
    </div>
</section>
