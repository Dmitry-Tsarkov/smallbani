<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>

  <slider-main inline-template>
    <div class="slider-main">
      <div class="slider-main__container" ref="container">
        <div class="slider-main__wrapper">
          <div class="slider-main__slide">
            <div class="slider-main__cover"></div><img class="slider-main__image" src="img/main-slider-1.jpg" alt="">
            <div class="container">
              <div class="slider-main__content">
                <p class="slider-main__text" data-swiper-parallax="-100">Производство <br> и продажа бань-бочек <br> по доступным ценам, <br> в кратчайшие сроки</p>
                <div class="slider-main__button" data-swiper-parallax="-50">
                  <button class="button is-detailed">Узнать подробнее</button>
                </div>
              </div>
            </div>
          </div>
          <div class="slider-main__slide">
            <div class="slider-main__cover"></div><img class="slider-main__image" src="img/main-slider-1.jpg" alt="">
            <div class="container">
              <div class="slider-main__content">
                <p class="slider-main__text" data-swiper-parallax="-100">Производство <br> и продажа бань-бочек </p>
                <div class="slider-main__button" data-swiper-parallax="-50">
                  <button class="button is-detailed">Узнать подробнее </button>
                </div>
              </div>
            </div>
          </div>
          <div class="slider-main__slide">
            <div class="slider-main__cover"></div><img class="slider-main__image" src="img/main-slider-1.jpg" alt="">
            <div class="container">
              <div class="slider-main__content">
                <p class="slider-main__text" data-swiper-parallax="-100">Производство <br> и продажа бань-бочек </p>
                <div class="slider-main__button" data-swiper-parallax="-50">
                  <button class="button is-detailed">Узнать подробнее        </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="slider-main__bullets" ref="pagination"></div>
        <div class="slider-main__controls">
          <div class="container">
            <button class="slider-main__control is-prev" ref="prev">             </button>
            <button class="slider-main__control is-last" ref="next"> </button>
          </div>
        </div>
      </div>
    </div>
  </slider-main>
  <section class="section">
    <div class="container">
      <header class="section__header">
        <h2 class="section__title">Преимущества</h2>
      </header>
      <div class="section__body">
        <div class="advantages">
          <div class="advantages__section">
            <div class="advantages__item"><img class="advantages__image" src="img/advantage-1.svg" alt="">
              <p class="advantages__text">Быстрый прогрев и сохранение тепла</p>
            </div>
            <div class="advantages__item"><img class="advantages__image" src="img/advantage-2.svg" alt="">
              <p class="advantages__text">Компактность <br> и эстетичность       </p>
            </div>
            <div class="advantages__item"><img class="advantages__image" src="img/advantage-3.svg" alt="">
              <p class="advantages__text">Мобильность <br> и транспортировка</p>
            </div>
            <div class="advantages__item"><img class="advantages__image" src="img/advantage-4.svg" alt="">
              <p class="advantages__text">Быстрая установка         </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="section">
    <div class="container">
      <header class="section__header">
        <h2 class="section__title">Самые популярные модели</h2>
      </header>
      <div class="section__body">
        <div class="grid is-row">
          <div class="col-3">
            <div class="product">
              <div class="product__cover"><img class="product__image" src="/img/product.jpg" alt=""></div>
              <h2 class="product__title">Дачный домик "Викинг"</h2>
              <div class="product__footer"><a class="button js-button is-product" area-label="Заказать за 178 000 ₽" href="/product-detailed.html">Заказать за 178 000 ₽</a>
              </div>
            </div>
          </div>
          <div class="col-3">
            <div class="product">
              <div class="product__cover"><img class="product__image" src="/img/product.jpg" alt=""></div>
              <h2 class="product__title">Дачный домик "Викинг"</h2>
              <div class="product__footer"><a class="button js-button is-product" area-label="Заказать за 178 000 ₽" href="/product-detailed.html">Заказать за 178 000 ₽</a>
              </div>
            </div>
          </div>
          <div class="col-3">
            <div class="product">
              <div class="product__cover"><img class="product__image" src="/img/product.jpg" alt=""></div>
              <h2 class="product__title">Дачный домик "Викинг"</h2>
              <div class="product__footer"><a class="button js-button is-product" area-label="Заказать за 178 000 ₽" href="/product-detailed.html">Заказать за 178 000 ₽</a>
              </div>
            </div>
          </div>
          <div class="col-3">
            <div class="product">
              <div class="product__cover"><img class="product__image" src="/img/product.jpg" alt=""></div>
              <h2 class="product__title">Дачный домик "Викинг"</h2>
              <div class="product__footer"><a class="button js-button is-product" area-label="Заказать за 178 000 ₽" href="/product-detailed.html">Заказать за 178 000 ₽</a>
              </div>
            </div>
          </div>
          <div class="col-3">
            <div class="product">
              <div class="product__cover"><img class="product__image" src="/img/product.jpg" alt=""></div>
              <h2 class="product__title">Дачный домик "Викинг"</h2>
              <div class="product__footer"><a class="button js-button is-product" area-label="Заказать за 178 000 ₽" href="/product-detailed.html">Заказать за 178 000 ₽</a>
              </div>
            </div>
          </div>
          <div class="col-3">
            <div class="product">
              <div class="product__cover"><img class="product__image" src="/img/product.jpg" alt=""></div>
              <h2 class="product__title">Дачный домик "Викинг"</h2>
              <div class="product__footer"><a class="button js-button is-product" area-label="Заказать за 178 000 ₽" href="/product-detailed.html">Заказать за 178 000 ₽</a>
              </div>
            </div>
          </div>
          <div class="col-3">
            <div class="product">
              <div class="product__cover"><img class="product__image" src="/img/product.jpg" alt=""></div>
              <h2 class="product__title">Дачный домик "Викинг"</h2>
              <div class="product__footer"><a class="button js-button is-product" area-label="Заказать за 178 000 ₽" href="/product-detailed.html">Заказать за 178 000 ₽</a>
              </div>
            </div>
          </div>
          <div class="col-3">
            <div class="product">
              <div class="product__cover"><img class="product__image" src="/img/product.jpg" alt=""></div>
              <h2 class="product__title">Дачный домик "Викинг"</h2>
              <div class="product__footer"><a class="button js-button is-product" area-label="Заказать за 178 000 ₽" href="/product-detailed.html">Заказать за 178 000 ₽</a>
              </div>
            </div>
          </div>
        </div><a class="button js-button unfill look-all" area-label="Смотреть все" href="/portfolio-detailed.html">Смотреть все</a>
      </div>
    </div>
  </section>
  <section class="section">
    <div class="container">
      <header class="section__header">
        <h2 class="section__title">Актуальные акции</h2>
      </header>
      <div class="section__body">
        <div class="grid is-row">
          <div class="col-4"><a class="stock" href="">
              <div class="stock__cover"><img class="stock__image" src="/img/stock.jpg" alt=""></div>
              <div class="stock__wrapper">
                <p class="stock__text">Специальные условия <br> для пенсионеров</p>
              </div></a>
          </div>
          <div class="col-4"><a class="stock" href="">
              <div class="stock__cover"><img class="stock__image" src="/img/stock.jpg" alt=""></div>
              <div class="stock__wrapper">
                <p class="stock__text">Специальные условия <br> для пенсионеров</p>
              </div></a>
          </div>
          <div class="col-4"><a class="stock" href="">
              <div class="stock__cover"><img class="stock__image" src="/img/stock.jpg" alt=""></div>
              <div class="stock__wrapper">
                <p class="stock__text">Специальные условия <br> для пенсионеров</p>
              </div></a>
          </div>
        </div><a class="button js-button unfill look-all" area-label="Смотреть все" href="/portfolio-detailed.html">Смотреть все</a>
      </div>
    </div>
  </section>
  <section class="section is-alt">
    <div class="container">
      <div class="section__body">
        <div class="video">
          <p class="video__headline">Что входит в установку “под ключ”</p>
          <div class="grid is-row">
            <div class="col-3">
              <div class="video__container"><img class="video__circle" src="img/option-1.svg" alt="">
                <p class="video__text">Доставка по Смоленской обл. <br> и России</p>
              </div>
              <div class="video__container"><img class="video__circle" src="img/option-3.svg" alt="">
                <p class="video__text">Установка с помощью крана-манипулятора</p>
              </div>
            </div>
            <div class="col-6">
              <div class="video__cover"><img class="video__image" src="img/video.jpg" alt=""><a href="https://www.youtube.com/watch?v=COTnn-VAGdg&amp;t=62s" target="_blank">
                  <button class="video__button"><img src="img/play.svg" alt=""></button></a></div>
            </div>
            <div class="col-3">
              <div class="video__container"><img class="video__circle" src="img/option-2.svg" alt="">
                <p class="video__text">Доставка по смоленской обл. и России</p>
              </div>
              <div class="video__container"><img class="video__circle" src="img/option-4.svg" alt="">
                <p class="video__text">Установка с помощью крана-манипулятора</p>
              </div>
            </div>
          </div>
          <div class="video__excursion">
            <p class="video__title">Соверши виртуальную <br> 3D экскурсию по бане бочке</p>
            <button class="button js-button is-product" area-label="Перейти к обзору панорамы">Перейти к обзору панорамы</button>
          </div>
        </div>
      </div>
    </div>
  </section>
  <slider-done inline-template>
    <div class="container">
      <div class="slider-done">
        <p class="slider-done__headline">Успели сделать и поставить</p>
        <div class="slider-done__container" ref="container">
          <div class="slider-done__wrapper">
            <div class="slider-done__slide">
              <div class="review">
                <div class="review__cover"><img class="review__image" src="img/avatar-1.svg" alt=""></div>
                <div class="review__content">
                  <p class="review__title">Виктор Сергеев, беседка в Красногорске</p>
                  <p class="review__text">В 2019 году я сдал ОГЭ по английскому языку на 5! Хочу выразить большую благодарность Марине Леонидовне за помощь в подготовке к экзамену. На данный момент я готовлюсь к ЕГЭ по английскому. Уверен, с такой опорой у меня всё получится!</p>
                </div>
              </div>
            </div>
            <div class="slider-done__slide">
              <div class="review">
                <div class="review__cover"><img class="review__image" src="img/avatar-1.svg" alt=""></div>
                <div class="review__content">
                  <p class="review__title">Виктор Сергеев, беседка в Красногорске</p>
                  <p class="review__text">В 2019 году я сдал ОГЭ по английскому языку на 5! Хочу выразить большую благодарность Марине Леонидовне за помощь в подготовке к экзамену. На данный момент я готовлюсь к ЕГЭ по английскому. Уверен, с такой опорой у меня всё получится!</p>
                </div>
              </div>
            </div>
            <div class="slider-done__slide">
              <div class="review">
                <div class="review__cover"><img class="review__image" src="img/avatar-1.svg" alt=""></div>
                <div class="review__content">
                  <p class="review__title">Виктор Сергеев, беседка в Красногорске</p>
                  <p class="review__text">В 2019 году я сдал ОГЭ по английскому языку на 5! Хочу выразить большую благодарность Марине Леонидовне за помощь в подготовке к экзамену. На данный момент я готовлюсь к ЕГЭ по английскому. Уверен, с такой опорой у меня всё получится!</p>
                </div>
              </div>
            </div>
            <div class="slider-done__slide">
              <div class="review">
                <div class="review__cover"><img class="review__image" src="img/avatar-1.svg" alt=""></div>
                <div class="review__content">
                  <p class="review__title">Виктор Сергеев, беседка в Красногорске</p>
                  <p class="review__text">В 2019 году я сдал ОГЭ по английскому языку на 5! Хочу выразить большую благодарность Марине Леонидовне за помощь в подготовке к экзамену. На данный момент я готовлюсь к ЕГЭ по английскому. Уверен, с такой опорой у меня всё получится!</p>
                </div>
              </div>
            </div>
          </div>
          <div class="slider-done__controls">
            <button class="slider-done__control is-prev" ref="prev">             </button>
            <button class="slider-done__control is-last" ref="next"> </button>
          </div>
        </div>
        <div class="slider-done__buttons">
          <button class="button">Попасть на просмотр</button>
          <button class="button unfill">Смотреть все отзывы</button>
        </div>
      </div>
    </div>
  </slider-done>
  <section class="section is-bcground">
    <div class="container">
      <div class="section__body">
        <div class="answers">
          <p class="answers__headline">Вопросы и ответы</p>
          <div class="answers__item">
            <accordion inline-template>
              <div class="accordion">
                <div class="accordion__item">
                  <div class="accordion__header" @click="toogle"><img class="accordion__image" src="img/triangle.svg" alt="" :class="{'is-active' : open}">
                    <p class="accordion__title">Сколько времени занимает установка бани</p>
                  </div>
                  <transition name="fade">
                    <div class="accordion__body" v-if="open">
                      <p class="accordion__text">В зависимости от поставленной задачи - поможем их организовать с различным уровнем проработки, будь это помощь в подготовке оформления презентации или же полная организация всего мероприятия с трансфером и организацией посадки гостей</p>
                    </div>
                  </transition>
                </div>
              </div>
            </accordion>
          </div>
          <div class="answers__item">
            <accordion inline-template>
              <div class="accordion">
                <div class="accordion__item">
                  <div class="accordion__header" @click="toogle"><img class="accordion__image" src="img/triangle.svg" alt="" :class="{'is-active' : open}">
                    <p class="accordion__title">Сколько времени занимает установка бани</p>
                  </div>
                  <transition name="fade">
                    <div class="accordion__body" v-if="open">
                      <p class="accordion__text">В зависимости от поставленной задачи - поможем их организовать с различным уровнем проработки, будь это помощь в подготовке оформления презентации или же полная организация всего мероприятия с трансфером и организацией посадки гостей</p>
                    </div>
                  </transition>
                </div>
              </div>
            </accordion>
          </div>
          <div class="answers__item">
            <accordion inline-template>
              <div class="accordion">
                <div class="accordion__item">
                  <div class="accordion__header" @click="toogle"><img class="accordion__image" src="img/triangle.svg" alt="" :class="{'is-active' : open}">
                    <p class="accordion__title">Сколько времени занимает установка бани</p>
                  </div>
                  <transition name="fade">
                    <div class="accordion__body" v-if="open">
                      <p class="accordion__text">В зависимости от поставленной задачи - поможем их организовать с различным уровнем проработки, будь это помощь в подготовке оформления презентации или же полная организация всего мероприятия с трансфером и организацией посадки гостей</p>
                    </div>
                  </transition>
                </div>
              </div>
            </accordion>
          </div>
          <form class="form is-answers" role="form" action="response.html">
            <div class="form__body">
              <div class="answers__container">
                <p class="answers__title">Если вопросы еще остались</p>
                <div class="answers__info">
                  <input class="answers__input" type="text" placeholder="Как вас зовут?">
                  <input class="answers__input email" type="text" placeholder="Электронный адрес">
                </div>
                <textarea class="answers__textarea"></textarea>
                <div class="answers__send">
                  <button class="button js-button is-send" area-label="Отправить">Отправить</button>
                  <input class="shipment__checkbox" type="checkbox"> Отправляя сообщение, вы соглашаетесь на Обработку персональных данных
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <section class="section">
    <div class="container">
      <div class="section__body">
        <div class="about-text">
          <p class="about-text__text">Наша компания занимается изготовлением бань <i><img src="img/about-icon-1.svg" alt=""></i>эконом-класса для людей, которые желают получить высокое качество при небольших затратах <i><img class="about-text__image" src="img/about-icon-2.svg" alt=""></i>. Попарившись в такой бане, вы больше не сможете отказывать себе в маленьких удовольствиях.</p>
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
          <div class="contact__emails">     <a class="contact__email" href="#">info@smallbani.ru</a></div>
        </div>
      </div>
    </div>
  </section>
