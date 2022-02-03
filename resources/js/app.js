require("./bootstrap");
import Vue from "vue";
import Category from "./components/Category";

const app = new Vue({
    el: "#app",
    components: { Category },
});

/* window.Vue = require("vue").default;

Vue.component("Category", require("./components/Category.vue").default);

const app = new Vue({
    el: "#app",
}); */
