import Vue from "vue";
import VueRouter from "vue-router";
import NotFound from "./views/NotFound";
import Home from "./views/web/Home";
import About from "./views/web/About";
import Login from "./views/auth/Login";
import Register from "./views/auth/Register";
import Dashboard from "./views/admin/Dashboard";
import Category from "./views/admin/category/Index.vue";
import Addcategory from "./views/admin/category/Create.vue";
import EditCategory from "./views/admin/category/Edit.vue";
Vue.use(VueRouter);
const routes = [
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
    { path: "/admin/category", component: Category },
    { path: "/admin/add-category", component: Addcategory },
    { path: "/admin/edit-category/:slug", component: EditCategory },
];

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
