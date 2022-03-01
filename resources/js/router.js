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
    { path: "/login", component: Login, name: "Login" },
    { path: "/register", component: Register },
    { path: "/", component: Home },
    { path: "/about", component: About },
    {
        path: "/dashboard",
        component: Dashboard,
        name: "Dashboard",
        meta: { requiresAuth: true },
    },
];

const isAuthenticated = localStorage.getItem("login_token") ? true : false;

const router = new VueRouter({
    mode: "history",
    linkActiveClass: "active",
    routes,
});
console.log(store.getters["auth/loggedIn"]);

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !isAuthenticated) next({ name: "Login" });
    else next();
});

export default router;
