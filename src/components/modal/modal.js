import Vue from "vue/dist/vue.common";


export default Vue.component("modal", {
  data() {
    return {
      show: false
    };
  },
  methods: {
    toogle(show) {
      this.show = !show
    },
  },
 
});