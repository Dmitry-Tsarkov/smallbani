import Vue from "vue/dist/vue.common";

export default Vue.component("v-header", {
  methods: {
    show() {
      this.$modal.show("order");
    },
  },
});
