<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;

/**
 * @var \yii\web\View $this
 * @var \app\modules\catalog\models\Product $product
 * @var array $categoriesDropDown
 */

?>

<?php $form = ActiveForm::begin() ?>
<?= $form->field($product, 'title') ?>
<?= $form->field($product, 'alias') ?>
<?= $form->field($product, 'status')->dropDownList([0 => 'Неактивный', 1 => 'Активный']) ?>
<?= $form->field($product, 'description')->textarea(['rows' => 7, 'cols' => 5]); ?>
<?= $form->field($product, 'category_id')->dropDownList($categoriesDropDown, ['prompt' => '-- Выберете категорию --']) ?>
<?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end() ?>
