<?php

use app\modules\characteristic\models\Characteristic;
use kartik\grid\DataColumn;
use kartik\grid\GridView;
use kartik\icons\Icon;
use yii\data\DataProviderInterface;
use yii\grid\ActionColumn;
use yii\helpers\Html;

/**
 * @var \yii\web\View $this
 * @var DataProviderInterface $dataProvider
 * @var app\modules\characteristic\models\CharacteristicSearch $searchModel
 * @var Characteristic $characteristic
 */

$this->title = $characteristic->title;
$this->params['breadcrumbs'] = [
    ['label' => 'Характеристики', 'url' => ['/characteristic/backend/characteristic/index']],
    ['label' => $characteristic->title, 'url' => ['/characteristic/backend/characteristic/update', 'id' => $characteristic->id]],
    'Варианты',
];

?>
<?php $this->beginContent('@app/modules/characteristic/views/backend/characteristic/layout.php', compact('characteristic')) ?>

<p>
    <?=  Html::a('Добавить вариант', ['/characteristic/backend/variant/create', 'id' => $characteristic->id], ['class' => 'btn btn-success', 'data-pjax' => '0'])  ?>
</p>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'summaryOptions' => ['class' => 'text-right'],
    'bordered' => false,
    'pjax' => true,
    'pjaxSettings' => [
        'options' => [
            'id' => 'pjax-widget'
        ],
    ],
    'striped' => false,
    'hover' => true,
    'panel' => false,
    'toolbar' => [
        [
            'content' =>
                Html::a('Добавить вариант', ['/characteristic/backend/variant/create', 'id' => $characteristic->id], ['class' => 'btn btn-success', 'data-pjax' => '0']) .
                Html::a(
                    Icon::show('arrow-sync-outline'),
                    ['index', 'id'=>$characteristic->id],
                    [
                        'data-pjax' => 0,
                        'class' => 'btn btn-default',
                        'title' => Yii::t('app', 'Reset')
                    ]
                )
        ],
        '{toggleData}',
    ],
    'export' => false,
    'toggleDataOptions' => [
        'all' => [
            'icon' => 'resize-full',
            'label' => 'Показать все',
            'class' => 'btn btn-default',
            'title' => 'Показать все'
        ],
        'page' => [
            'icon' => 'resize-small',
            'label' => 'Страницы',
            'class' => 'btn btn-default',
            'title' => 'Постаничная разбивка'
        ],
    ],
    'columns' => [
        [
            'class' => DataColumn::class,
            'vAlign' => GridView::ALIGN_MIDDLE,
            'hAlign' => GridView::ALIGN_CENTER,
            'attribute' => 'id',
            'format' => 'raw',
            'width' => '70px',

        ],
        'value',
        'characteristic_id',
        [
            'class' => ActionColumn::className(),
            'template' => '{update} {delete}',
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    return Html::a('Редактировать', $url, ['class' => 'btn btn-primary btn-xs', 'data-pjax' => '0']);
                },
                'delete' => function ($url, $model, $key) {
                    return Html::a('<i class="fa fa-trash" aria-hidden="true"></i>', [
                        '/characteristic/backend/variant/delete',
                        'id' => $model->id,
                    ],
                        ['class' => 'btn btn-danger btn-xs', 'data-pjax' => '0', 'data-confirm' => 'Вы уверены?', 'data-method' => 'post']);
                },
            ],
        ],
    ]
])
?>
<?php $this->endContent() ?>

