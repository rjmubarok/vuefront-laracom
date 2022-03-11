import Vue from "vue";
import Vuex from "vuex";
import auth from "./modules/auth";
import StoreData from "./modules/store"
import brand from "./modules/brand"

Vue.use(Vuex);

const store = new Vuex.Store({
    modules: {
        auth,
        StoreData,
        brand,
    },
});

export default store;
