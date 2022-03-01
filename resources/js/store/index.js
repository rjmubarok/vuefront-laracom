import Vue from "vue";
import Vuex from "vuex";
import auth from "./modules/auth";
import StoreData from "./modules/store"

Vue.use(Vuex);

const store = new Vuex.Store({
    modules: {
        auth,
        StoreData,
    },
});

export default store;
