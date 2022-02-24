import Vue from "vue";
import VueRouter from "vue-router";
import Home from "./views/Home";
import About from "./views/About";
import Login from "./views/Login";
import Register from "./views/Register";
import Dashboard from "./views/Dashboard";
import NotFound from "./views/NotFound";
import store from "./store";

Vue.use(VueRouter);

const routes = [
    { path: "*", component: NotFound },
    { path: "/login", component: Login },
    { path: "/register", component: Register },
    { path: "/", component: Home },
    { path: "/about", component: About },
    { path: "/dashboard", component: Dashboard, name: "Dashboard" },
];

const router = new VueRouter({
    //history: createWebHistory(),
    mode: "history",
    linkActiveClass: "active",
    routes,
});
console.log(store);
/* router.beforeEach((to, from, next) => {
    if (to.name !== "Login" && !store.getters("auth/Authenticated"))
        next({ name: "Login" });
    else next();
}); */
export default router;
