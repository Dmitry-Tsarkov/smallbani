import Vue from "vue/dist/vue.common";

export default Vue.component("accordion", {
  data() {
    return {
      open: false,
    };
  },
  methods: {
    toogle() {
      this.open = !this.open;
    },
  },
});
