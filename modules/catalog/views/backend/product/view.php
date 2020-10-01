<?php

use yii\widgets\DetailView;

/**
 * @var \yii\web\View $this
 * @var \app\modules\catalog\models\Product $product
 */

$this->title = $product->title;
$this->params['breadcrumbs'] = [
    ['label' => 'Товар', 'url' => ['index']],
    $product->title,
];

?>

<p>
    <?= \yii\helpers\Html::a('Редактировать', ['update', 'id' => $product->id], ['class' => 'btn btn-primary btn-sm']) ?>
</p>

<div class="row">
    <div class="col-lg-6">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Общее</h3>
            </div>
            <?= DetailView::widget([
                'model' => $product,
                'attributes' => [
                    'id',
                    [
                        'label' => 'Статус',
                        'format' => 'raw',
                        'value' => $product->status ? '<span class="label label-success" data-test="123">Активен</span>' : '<span class="label label-danger">Черновик</span>',
                    ],
                    'title',
                    'alias',

                    [
                        'label' => 'Категория',
                        'value' => $product->category->title ?? '-',
                    ],                             // description свойство, как HTML
                    [
                        'label' => 'Дата создания',
                        'value' => date('d.m.Y H:i', $product->created_at)
                    ],
                    [
                        'label' => 'Дата редактирования',
                        'value' => date('d.m.Y H:i', $product->updated_at)
                    ],
                ],
            ]); ?>
        </div>

    </div>
    <div class="col-lg-6">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Характеристики</h3>
            </div>
        </div>
    </div>
</div>

<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Описание</h3>
    </div>
    <div class="box-body">
        <?= $product->description ?>
    </div>
</div>

<?php foreach($product->images as $image): ?>
<?= \yii\helpers\Html::img($image->getImageFileUrl('image')) ?>
<?php endforeach;?>
