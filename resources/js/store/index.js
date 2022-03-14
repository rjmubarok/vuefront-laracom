import Vue from "vue";
import Vuex from "vuex";
import auth from "./modules/auth";
import category from "./modules/category";

Vue.use(Vuex);

const store = new Vuex.Store({
    modules: {
        auth,
        category,
    },
});

export default store;
