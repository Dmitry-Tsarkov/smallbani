import Vue from "vue/dist/vue.common";

import Swiper from "swiper";

export default Vue.component("slider-photos", {
  mounted() {
    new Swiper(this.$refs.container, {
      wrapperClass: "slider-photos__wrapper",
      slideClass: "slider-photos__slide",
      simulateTouch: true,
      speed: 700,
      navigation: {
        nextEl: this.$refs.next,
        prevEl: this.$refs.prev,
      },
      pagination: {
        el: this.$refs.pagination,
        clickable: true,
      },
      effect: "fade",
      parallax: true,
      autoplay: {
        delay: 5000,
      },
    });
  },
});
