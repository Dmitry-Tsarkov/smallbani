<?php

use app\modules\catalog\forms\ColourGroupForm;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Html;

/**
 * @var \yii\web\View $this
 * @var ColourGroupForm $groupForm
 */
?>


<?php $form = ActiveForm::begin() ?>
    <div class="box box-default">
        <div class="box-body ">
            <div class="row">
                <div class="col-xs-8">
                    <?= $form->field($groupForm, 'title'); ?>
                    <?= $form->field($groupForm, 'colourIds')->widget(Select2::class, [
                        'data' => $groupForm->getColoursDropDown(),
                        'maintainOrder' => true,
                        'options' => ['placeholder' => 'Выберите цвет ...', 'multiple' => true],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>

<?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end() ?>
