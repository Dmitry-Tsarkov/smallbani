<?php

use app\modules\colour\helpers\ColourHelper;
use app\modules\order\helpers\OrderHelper;
use app\modules\order\models\OrderModification;
use kartik\form\ActiveForm;
use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var \yii\web\View $this
 * @var \app\modules\order\models\Order $order
 * @var \app\modules\order\forms\OrderStatusForm $statusForm
 *
 */

$this->title = 'Заказ: #'. $order->id;
$this->params['breadcrumbs'] = [
    [
        'label' => 'Заказы',
        'url' => ['index'],
    ],
    [
        'label' => $order->id,
    ],
];

$this->beginBlock('content-header');
$this->endBlock();

?>

<section class="invoice">
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                <?= $this->title ?>
                <small class="pull-right">Дата заказа: <?= date('d.m.Y H:i', $order->created_at) ?></small>
            </h2>
            <div style="display: flex; margin-bottom: 15px;">
                <?php $form = ActiveForm::begin([
                    'action' => ['change-status', 'id' => $order->id],
                    'type' => ActiveForm::TYPE_INLINE,
                    'options' => [
                        'style' => 'margin-right: 15px;',
                    ],

                ]) ?>
                <?= $form->field($statusForm, 'status')->dropDownList($statusForm->getStatusesDropDown()) ?>
                <?= Html::submitButton('Сменить статус', ['class' => 'btn btn-success']) ?>
                <?php ActiveForm::end() ?>

                <?php if ($order->isDelete()): ?>
                    <?= Html::a('Удалить', ['delete', 'id' => $order->id], ['class' => 'btn btn-danger', 'data-method' => 'post', 'data-confirm' => 'Вы уверены?']) ?>
                <?php endif ?>
            </div>



        </div>
        <div class="col-xs-6">
            <?= DetailView::widget([
                'model' => $order,
                'attributes' => [
                    'id',
                    [
                        'label' => 'Статус',
                        'format' => 'raw',
                        'value' => OrderHelper::statusLabelHtml($order->status),
                    ],
                    'phone',
                    'name',
                ],
            ]); ?>
        </div>
        <div class="col-xs-6">
            <?= DetailView::widget([
                'model' => $order,
                'attributes' => array_merge([
                    [
                        'label' => 'Товар',
                        'format' => 'raw',
                        'value' => $order->product_id
                            ? Html::a($order->product_title, ['/catalog/backend/product/view', 'id' => $order->product_id])
                            : $order->product_title,
                    ],
                ],
                    array_map(function(OrderModification $orderModification) {
                        return [
                            'label' => $orderModification->modification_title,
                            'format' => 'raw',
                            'value' => ColourHelper::getHtml($orderModification->modification_colour_title, $orderModification->modification_colour_hex),
                        ];
                    }, $order->orderModifications)
                )
            ]); ?>
        </div>
    </div>

</section>
