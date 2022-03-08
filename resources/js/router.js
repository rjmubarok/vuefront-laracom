import Vue from "vue";
import VueRouter from "vue-router";
import Home from "./views/Home";
import About from "./views/About";
import Login from "./views/Login";
import Register from "./views/Register";
import Dashboard from "./views/Dashboard";
import NotFound from "./views/NotFound";
<<<<<<< HEAD
import Category from "./components/admin/category/Index.vue"
import Addcategory from "./components/admin/category/Create.vue"
import EditCategory from "./components/admin/category/Edit.vue"
=======
import store from "./store";

>>>>>>> 3306801a8f6082a187d2ac25391ed24ea8fa5296
Vue.use(VueRouter);
const routes = [
    { path: "*", component: NotFound },
    { path: "/login", component: Login, name: "Login" },
    { path: "/register", component: Register },
    { path: "/", component: Home },
    { path: "/about", component: About },
<<<<<<< HEAD
    { path: "/dashboard", component: Dashboard, name: "Dashboard" },
    { path: "/categories", component:Category},
    { path: "/add-category", component:Addcategory},
    { path: '/edit-category/:slug', component:EditCategory},
=======
    {
        path: "/dashboard",
        component: Dashboard,
        name: "Dashboard",
        meta: { requiresAuth: true },
    },
>>>>>>> 3306801a8f6082a187d2ac25391ed24ea8fa5296
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
