import Vue from "vue/dist/vue.common";


export default Vue.component("tabs", {
  data() {
    return {
      tabId: 1
    };
  },
  methods: {
    toogle(id) {
      this.tabId = id
    },
  },
 
});