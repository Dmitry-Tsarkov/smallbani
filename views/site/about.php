<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->params['breadcrumbs'] = \app\modules\page\components\Pages::getBreadcrumbs();
\app\modules\page\components\Pages::getCurrentPage()->generateMetaTags();

?>
<div class="site-about">
<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->
    <section class="section">
        <div class="container">
            <div class="section__body">
                <div class="about-text">
                    <p class="about-text__text">Наша компания занимается изготовлением бань <i><img
                                src="img/about-icon-1.svg" alt=""></i>эконом-класса для людей, которые желают получить
                        высокое качество при небольших затратах <i><img class="about-text__image"
                                                                        src="img/about-icon-2.svg" alt=""></i>.
                        Попарившись в такой бане, вы больше не сможете отказывать себе в маленьких удовольствиях.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="section__body">
                <div class="about-us">
                    <div class="grid is-row">
                        <div class="col-3">
                            <div class="about-us__box"><img class="about-us__image" src="img/solution-1.svg" alt="">
                                <p class="about-us__description">Опыт в деревообработке с 1999 года</p>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="about-us__box"><img class="about-us__image" src="img/solution-2.svg" alt="">
                                <p class="about-us__description">Контроль качества на всех стадиях производства</p>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="about-us__box"><img class="about-us__image" src="img/solution-3.svg" alt="">
                                <p class="about-us__description">Гарантия надежнос­ти и долговечности от
                                    производителя</p>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="about-us__box"><img class="about-us__image" src="img/solution-4.svg" alt="">
                                <p class="about-us__description">1000 доволь­ных покупателей по всей России </p>
                            </div>
                        </div>
                        <div class="col-6">
                            <ul class="about-us__list">
                                <li class="about-us__item">
                                    <p class="about-us__text">Крупнейший завод-изготовитель бань-бочек в Башкирии. Общая
                                        площадь цехов (заготовочный, столярный, цех металлообработки, сборочный участок)
                                        составляет порядка двух с половиной тысяч квадратных метров;</p>
                                </li>
                                <li class="about-us__item">
                                    <p class="about-us__text">Собственная производственная линейка, созданная
                                        профессионалами с огромным опытом создания деревообрабатывающего
                                        оборудования;</p>
                                </li>
                                <li class="about-us__item">
                                    <p class="about-us__text">Специальная конструкция, учитывающая особенности древесины
                                        <br> в климатических условиях России;</p>
                                </li>
                                <li class="about-us__item">
                                    <p class="about-us__text">Оборудование собственного производства, позволяющее
                                        изготавливать качественные бани быстро и недорого;</p>
                                </li>
                                <li class="about-us__item">
                                    <p class="about-us__text">Низкая цена, за счет высокой заводской
                                        производительности;</p>
                                </li>
                                <li class="about-us__item">
                                    <p class="about-us__text">Постоянный контроль качества выпускаемой продукции;</p>
                                </li>
                                <li class="about-us__item">
                                    <p class="about-us__text">Постоянная модернизация оборудования и улучшение
                                        конструкции бань-бочек, чтобы сделать бани еще более качественными и
                                        недорогими;</p>
                                </li>
                                <li class="about-us__item">
                                    <p class="about-us__text">Доступность продукции по всей России.</p>
                                </li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <div class="about-us__container"><img class="about-us__image is-big"
                                                                  src="img/solution-6.svg" alt="">
                                <p class="about-us__description">Наше производство находится на закрытой <br> территории
                                    в теплом цеху, что-бы ничто не <br> отвлекало от атмосферы создания уюта и тепла,
                                    которое мы передадим Вам. Каждая баня получает комплекс влаго, огне-биозащиты, цвет
                                    внешней пропитки под благородное дерево предварительно согласовывается с Вами.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="section__body">
                <div class="contact">
                    <div class="contact__addresses">
                        <p class="contact__address">г. Смоленск</p>
                        <p class="contact__title">пос. Тихвинка, 69</p>
                        <p class="contact__title">пос. Тихвинка 10</p>
                        <p class="contact__subtitle">(рядом с оптовым продуктовым рынком <br> и остановкой Аэропорт)</p>
                    </div>
                    <div class="contact__phones">
                        <p class="contact__phone">+8 (920) 338 91 69</p>
                        <p class="contact__phone">+8 (800) 201 42 91</p>
                        <p class="contact__phone">510-110</p>
                    </div>
                    <div class="contact__emails"><a class="contact__email" href="#">info@smallbani.ru</a></div>
                </div>
            </div>
        </div>
    </section>

    <?= \app\modules\page\components\Pages::getCurrentPage()->content ?>
<!--    <code>--><?//= __FILE__ ?><!--</code>-->
</div>
