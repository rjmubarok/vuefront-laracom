import Vue from "vue";
import VueRouter from "vue-router";
import Home from "./views/Home";
import About from "./views/About";
import Login from "./views/Login";
import Register from "./views/Register";
import Dashboard from "./views/Dashboard";
import NotFound from "./views/NotFound";
import Category from "./views/admin/category/Index.vue";
import Addcategory from "./views/admin/category/Create.vue";
import EditCategory from "./views/admin/category/Edit.vue";
Vue.use(VueRouter);
const routes = [
    { path: "*", component: NotFound },
    { path: "/login", component: Login, name: "login" },
    { path: "/register", component: Register },
    { path: "/", component: Home },
    { path: "/about", component: About },
    { path: "/admin", component: Dashboard },
    { path: "/admin/dashboard", component: Dashboard, name: "dashboard" },
    { path: "/admin/categories", component: Category, name: "category" },
    {
        path: "/admin/add-category",
        component: Addcategory,
        name: "addCategory",
    },
    {
        path: "/admin/edit-category/:slug",
        component: EditCategory,
        name: "editCategory",
    },
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
