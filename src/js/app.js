import "./lib/hello";

import Vue from "vue/dist/vue.common";

import SliderMain from "../components/slider-main/slider-main";
import SliderDone from "../components/slider-done/slider-done";
import Accordion from "../components/accordion/accordion";
import Tabs from "../components/tabs/tabs";
import SliderProduct from "../components/slider-product/slider-product";
import SliderBlueprint from "../components/slider-blueprint/slider-blueprint";
import SliderPhotos from "../components/slider-photos/slider-photos";
import Portfolio from "../components/portfolio/portfolio";
import Header from "../components/header/header";
import SliderPortfolio from "../components/slider-portfolio/slider-portfolio";
import VModal from "vue-js-modal";
Vue.use(VModal);
new Vue({
  el: "#page",
  components: {
    SliderMain,
    SliderDone,
    Accordion,
    Tabs,
    SliderBlueprint,
    SliderPhotos,
    Portfolio,
    SliderPortfolio,
    Header,
  },
});
