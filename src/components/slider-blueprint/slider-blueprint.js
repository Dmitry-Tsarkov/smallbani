import Vue from "vue/dist/vue.common";

import Swiper from "swiper";

export default Vue.component("slider-blueprint", {
  mounted() {
    new Swiper(this.$refs.container, {
      wrapperClass: "slider-blueprint__wrapper",
      slideClass: "slider-blueprint__slide",
      simulateTouch: true,
      speed: 700,
      slidesPerView: 3,
      spaceBetween: 80,
      navigation: {
        nextEl: this.$refs.next,
        prevEl: this.$refs.prev,
      },
    });
  },
});
