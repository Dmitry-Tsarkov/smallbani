<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;


/**
 * @var \yii\web\View $this
 * @var \app\modules\portfolio\models\PortfolioCategory $category
 */

$this->title = 'Редактирование ' . $category->title;
$this->params['breadcrumbs'] = [
    ['label' => 'Катекгория', 'url' => ['/portfolio/backend/category/index']],
    $category->title,
];

?>

<?php $form = ActiveForm::begin() ?>
    <div class="box box-default box-solid">
        <div class="box-body">
            <?= $form->field($category, 'title') ?>
            <?= $form->field($category, 'alias') ?>
        </div>
    </div>

    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end() ?>


