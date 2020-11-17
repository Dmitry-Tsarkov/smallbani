<?php

?>
<form action="">
    <div class="form__body">
            <p class="answers__title">Если вопросы еще остались</p>

                <input class="answers__input" type="text" placeholder="Как вас зовут?">
                <input class="answers__input email" type="text" placeholder="Электронный адрес">

            <textarea class="answers__textarea"></textarea>

                <button class="button js-button is-send" area-label="Отправить">Отправить</button>
                <input class="shipment__checkbox" type="checkbox"> Отправляя сообщение, вы соглашаетесь на Обработку
                персональных данных

        </div>
    </div>
</form>

<?php //use yii\helpers\ArrayHelper;
//use yii\helpers\Html;
//use yii\widgets\ActiveForm;
//
//$form = ActiveForm::begin([
//    'action' => ''
//]) ?>
<!---->
<?//= Html::activeHiddenInput($orderForm, 'productId', ['value' => $product->id]) ?>
<?//= $form->field($orderForm, 'name') ?>
<?//= $form->field($orderForm, 'phone') ?>
<!---->
<?//= Html::submitButton() ?>
<?php //ActiveForm::end() ?>
