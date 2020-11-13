<?php

/* @var $this \yii\web\View */

use app\modules\page\components\Pages;

$this->params['breadcrumbs'] = Pages::getBreadcrumbs();
Pages::getCurrentPage()->generateMetaTags();

?>

<section class="section">
    <div class="container">
        <header class="section__header">
            <h2 class="section__title">Доставка</h2>
        </header>
        <div class="section__body">
            <div class="delivery">
                <div class="grid is-row">
                    <div class="col-9">
                        <p class="delivery__text">Наша компания занимается изготовлением бань эконом-класса. Основной заказчик — люди, желающие получить высокое качество изделия при небольших затратах. Поверьте, попарившись в такой бане, вам не захочется больше отказывать себе в маленьких удовольствиях    </p>
                        <p class="delivery__text">Распространение бань-бочек началось от финнов, где знают толк в банях. Постоянный поиск современных технологий и истинных качеств дерева позволили создать недорогую баню, максимально компактную внешне и довольно просторную внутри. А наши специалисты помогут Вам воплотить свое видение бани в реальность</p>
                        <p class="delivery__text">Наше производство находится на закрытой территории в теплом цеху, что-бы ничто не отвлекало от атмосферы создания уюта и тепла, которое мы передадим Вам. Каждая баня получает комплекс влаго, огне-биозащиты, цвет внешней пропитки под благородное дерево предварительно согласовывается с Вами.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section">
    <div class="container">
        <header class="section__header">
            <h2 class="section__title">Оплата</h2>
        </header>
        <div class="section__body">
            <div class="grid is-row">
                <div class="col-9">
                    <p style="font-size: 20px; line-height: 26px">Наша компания занимается изготовлением бань эконом-класса. Основной заказчик — люди, желающие получить высокое качество изделия при небольших затратах. Поверьте, попарившись в такой бане, вам не захочется больше отказывать себе в маленьких удовольствиях</p>
                </div>
            </div>
        </div>
    </div>
</section>

