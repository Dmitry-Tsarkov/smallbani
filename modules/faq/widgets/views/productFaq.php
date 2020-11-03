<?php



/* @var $this \yii\web\View */
/* @var $questions \app\modules\faq\models\Question[] $questions
 */

?>

<?php if(!empty($questions)):?>
<div class="answers__item">
    <?php foreach ($questions as $question):?>
    <accordion inline-template>
        <div class="accordion is-left">
            <div class="accordion__item">
                <div class="accordion__header" @click="toogle"><img class="accordion__image" src="/img/triangle.svg" alt="" :class="{'is-active' : open}">
                    <p class="accordion__title"><?= $question->question?></p>
                </div>
                <transition name="fade">
                    <div class="accordion__body" v-if="open">
                        <p class="accordion__text"><?= $question->answer?></p>
                    </div>
                </transition>
            </div>
        </div>
    </accordion>
    <?php endforeach;?>
</div>
<?php endif?>
