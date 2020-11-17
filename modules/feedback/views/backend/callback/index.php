<?php

use app\modules\feedback\models\Feedback;
use app\modules\feedback\models\FeedbackStatus;
use kartik\grid\CheckboxColumn;
use kartik\grid\DataColumn;
use kartik\grid\GridView;
use yii\data\DataProviderInterface;
use yii\helpers\Html;

/**
 * @var \yii\web\View $this
 * @var DataProviderInterface $dataProvider
 * @var \app\modules\feedback\models\FeedbackCallbackSearch $searchModel
 */

?>
<?php $this->beginContent('@app/modules/feedback/views/backend/layout.php', compact('searchModel')) ?>

<?= GridView::widget([
    'id' => 'grid',
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
    'panel' => [
        'after' => false,
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
            'class' => CheckboxColumn::class,
            'checkboxOptions' => ['onchange' => 'appMassiveActions.updateActions()'],
        ],
        [
            'class' => DataColumn::class,
            'attribute' => 'created_at',
            'value' => function(Feedback  $feedback){
                return date('d.m.Y H:i',$feedback->created_at);
            }
        ],
        [
            'class' => DataColumn::class,
            'attribute' => 'status',
            'label' => 'Статус',
            'filter' => FeedbackStatus::list(),
            'format' => 'raw',
            'value' => function(Feedback $feedback) {
                return Html::a($feedback->status->getLabel(), ['view', 'id' => $feedback->id], [
                    'class' => 'btn btn-' . $feedback->status->getClass() . ' btn-xs',
                    'data-pjax' => '0',
                    'data-toggle' => 'modal',
                    'data-target' => '#modal-lg'
                ]);
            },
        ],
        'name',
        'phone',
    ]
]) ?>
<?php $this->endContent() ?>

<style>
    #actions {
        visibility: hidden;
        padding: 5px;
        background: rgb(248, 248, 248);
        border: 1px solid rgb(221, 221, 221);
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        z-index: 2000;
    }
</style>

<div id="actions" :style="{ visibility: isActive ? 'visible' : 'hidden' }" class="form-inline">
    <div class="container">
        <div class="form-group" style="width: 100px;">
            <span>Выбрано:</span>
            <b class="form-control-static">{{ ids.length }}</b>
        </div>
        <select v-bind:disabled="!isActive" v-model="action" class="form-control input-sm">
            <option disabled selected hidden :value="null">- Действия -</option>
            <option v-for="(action, index) in actions" v-bind:value="index">{{ action.title }}</option>
        </select>
        <div class="form-group">
            <select v-if="showStatusList" v-model="statusId" class="form-control input-sm">.
                <option disabled selected hidden :value="null">- Выберите статус -</option>
                <?php foreach (FeedbackStatus::list() as $id => $title): ?>
                    <option value="<?= $id ?>"><?= $title ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <button v-if="showButton" type="button" @click="send" class="btn btn-sm btn-primary">Применить</button>
    </div>

</div>


<?php $js = <<<JS

   appMassiveActions = new Vue({
      el: '#actions',
      data: {
          isReady: true,
        statusId: null,
        action: null,
        ids: [],
        actions: [
            {
                'title': 'Сменить статус',
                'url': '/feedback/backend/massive/status',
                'is_status_list' : true,
            },
            {
                'title': 'Удалить',
                'url': '/feedback/backend/massive/delete',
                'confirm': 'Подтвердите удаление',
            },
        ],
      },

      computed: {
          showButton: function() {
              let action =  this.actions[this.action];
              return this.isActive && action && (action.is_status_list ? this.statusId : true);
          },
          showStatusList: function() {
              let action =  this.actions[this.action];
              return this.isActive && action && action.is_status_list;
          },
          isActive: function() {
              return this.ids.length > 0;
          }
      },

      methods: {
          updateActions: function() {
              this.ids = $("#grid").yiiGridView("getSelectedRows");
          },
          send: function() {
              let _this = this;
              let action =  this.actions[this.action];
              let data = {ids: this.ids};

              if (action.is_status_list) {
                  data.statusId = this.statusId;
              }

              if (!action.confirm || confirm(action.confirm)) {
                   $.post(action.url, data, function(data) {
                        $.pjax.reload('#pjax-widget');
                        _this.ids = [];
                        _this.action = null;
                  });
              }

          }
      }
    });
    $(document).on('change', '.select-on-check-all', appMassiveActions.updateActions)
JS
?>

<?php $this->registerJs($js, \yii\web\View::POS_END) ?>


