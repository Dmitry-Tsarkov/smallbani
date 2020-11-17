<?php



/* @var $this \yii\web\View */
/* @var $questions \app\modules\faq\models\Question[] $questions
 */

use app\modules\feedback\widgets\FeedbackWidget;

?>

<?php if(!empty($questions)):?>
<section class="section is-bcground">
    <div class="container">
        <div class="section__body">
            <div class="answers">
                <p class="answers__headline">Вопросы и ответы</p>
                <div class="answers__item">
                    <?php foreach ($questions as $question):?>
                    <accordion inline-template>
                        <div class="accordion">
                            <div class="accordion__item">
                                <div class="accordion__header" @click="toogle"><img class="accordion__image"
                                                                                    src="img/triangle.svg" alt=""
                                                                                    :class="{'is-active' : open}">
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
                    <form class="form is-answers" role="form" action="response.html">
                        <div class="form__body">
                            <div class="answers__container">
                                <?= FeedbackWidget::widget() ?>
                                <p class="answers__title">Если вопросы еще остались</p>
                                <div class="answers__info">
                                    <input class="answers__input" type="text" placeholder="Как вас зовут?">
                                    <input class="answers__input email" type="text" placeholder="Электронный адрес">
                                </div>
                                <textarea class="answers__textarea"></textarea>
                                <div class="answers__send">
                                    <button class="button js-button is-send" area-label="Отправить">Отправить</button>
                                    <input class="shipment__checkbox" type="checkbox"> Отправляя сообщение, вы соглашаетесь
                                    на Обработку персональных данных
                                </div>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</section>
<?php endif?>
