<?php


use app\modules\feedback\forms\CallbackForm;
use app\modules\feedback\forms\FeedbackForm;
use app\modules\feedback\forms\PortfolioForm;
use app\modules\feedback\forms\PreviewForm;
use kartik\form\ActiveForm;
use yii\helpers\Html;

/**
 * @var \yii\web\View $this
 * @var \app\modules\feedback\forms\FeedbackForm $feedbackForm
 * @var \app\modules\feedback\forms\CallbackForm $callbackForm
 * @var PortfolioForm $portfolioForm
 */

$feedbackForm = new FeedbackForm();
$callbackForm = new CallbackForm();
$portfolioForm = new PortfolioForm();
$previewForm = new PreviewForm();


?>

<br>
callbckForm
<?php

$form = ActiveForm::begin([
    'action' => '/feedback/frontend/callback',
    'enableAjaxValidation' => true,
]) ?>
<?= $form->field($callbackForm, 'name') ?>
<?= $form->field($callbackForm, 'phone') ?>

<?= Html::submitButton() ?>

<?php ActiveForm::end() ?>

<br>
FeedbackForm
<?php

$form = ActiveForm::begin([
    'action' => '/feedback/frontend/feedback',
    'enableAjaxValidation' => true,
]) ?>
<?= $form->field($feedbackForm, 'name') ?>
<?= $form->field($feedbackForm, 'email') ?>
<?= $form->field($feedbackForm, 'text')->textarea() ?>

<?= Html::submitButton() ?>

<?php ActiveForm::end() ?>


<br>
PortfolioForm
<?php

$form = ActiveForm::begin([
    'action' => '/feedback/frontend/portfolio',
    'enableAjaxValidation' => true,
]) ?>

<?= Html::activeHiddenInput($portfolioForm, 'portfolioId',  ['value' => 1]) ?>
<?= $form->field($portfolioForm, 'name') ?>
<?= $form->field($portfolioForm, 'phone') ?>

<?= Html::submitButton() ?>

<?php ActiveForm::end() ?>


<br>
PreviewForm
<?php

$form = ActiveForm::begin([
    'action' => '/feedback/frontend/preview',
    'enableAjaxValidation' => true,
]) ?>

<?= $form->field($previewForm, 'name') ?>
<?= $form->field($previewForm, 'phone') ?>

<?= Html::submitButton() ?>

<?php ActiveForm::end() ?>


<br>
PreviewForm from Portfolio
<?php

$form = ActiveForm::begin([
    'action' => '/feedback/frontend/preview-portfolio',
    'enableAjaxValidation' => true,
]) ?>

<?= Html::activeHiddenInput($previewForm, 'portfolioId',  ['value' => 1]) ?>
<?= $form->field($previewForm, 'name') ?>
<?= $form->field($previewForm, 'phone') ?>

<?= Html::submitButton() ?>

<?php ActiveForm::end() ?>


<br>
PreviewForm from Product
<?php

$form = ActiveForm::begin([
    'action' => '/feedback/frontend/preview-product',
    'enableAjaxValidation' => true,
]) ?>

<?= Html::activeHiddenInput($previewForm, 'productId',  ['value' => 1]) ?>
<?= $form->field($previewForm, 'name') ?>
<?= $form->field($previewForm, 'phone') ?>

<?= Html::submitButton() ?>

<?php ActiveForm::end() ?>

