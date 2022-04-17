import Vue from "vue";
import VueRouter from "vue-router";
import NotFound from "./views/NotFound";
import Home from "./views/web/Home";
import About from "./views/web/About";
import Login from "./views/auth/Login";
import Register from "./views/auth/Register";
import Dashboard from "./views/admin/Dashboard";
import categoryRoutes from "./views/admin/category/router";
import BrandRoutes from "./views/admin/brand/router";

Vue.use(VueRouter);
let routes = [
    { path: "*", component: NotFound },
    { path: "/login", component: Login, name: "Login" },
    { path: "/register", component: Register },
    { path: "/", component: Home },
    { path: "/about", component: About },
    { path: "/admin", component: Dashboard, meta: { requiresAuth: true } },
    {
        path: "/admin/dashboard",
        component: Dashboard,
        meta: { requiresAuth: true },
        name: "Dashboard",
    },
];
routes = routes.concat(categoryRoutes, BrandRoutes);
const router = new VueRouter({
    mode: "history",
    linkActiveClass: "active",
    routes,
});

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth) {
        let authenticated = !!localStorage.getItem("login_token");
        if (!authenticated) next({ name: "Login" });
        else next();
    } else next();
});

export default router;
