import Vue from "vue/dist/vue.common";

import Swiper from "swiper";

export default Vue.component("slider-done", {
  mounted() {
    new Swiper(this.$refs.container, {
      wrapperClass: "slider-done__wrapper",
      slideClass: "slider-done__slide",
      simulateTouch: true,
      speed: 700,
      width: 670,
      spaceBetween: 30,
      navigation: {
        nextEl: this.$refs.next,
        prevEl: this.$refs.prev,
      },
    });
  },
});
