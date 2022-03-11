import Vue from "vue";
import VueRouter from "vue-router";
import Home from "./views/Home";
import About from "./views/About";
import Login from "./views/Login";
import Register from "./views/Register";
import Dashboard from "./views/Dashboard";
import NotFound from "./views/NotFound";
//category
import Category from "./components/admin/category/Index.vue"
import Addcategory from "./components/admin/category/Create.vue"
import EditCategory from "./components/admin/category/Edit.vue"
//brand
import Brand from "./components/admin/brand/Index.vue"
import AddBrand from "./components/admin/brand/Create.vue"
import EditBrand from "./components/admin/brand/Edit.vue"


Vue.use(VueRouter);
const routes = [
    { path: "*", component: NotFound },
    { path: "/login", component: Login, name: "Login" },
    { path: "/register", component: Register },
    { path: "/", component: Home },
    { path: "/about", component: About },
    { path: "/dashboard", component: Dashboard, name: "Dashboard" },
    //category
    { path: "/categories", component:Category},
    { path: "/add-category", component:Addcategory},
    { path: '/edit-category/:slug', component:EditCategory},
    //brand
    { path: "/brands", component:Brand},
    { path: "/add-brand", component:AddBrand},
    { path: '/edit-brand/:slug', component:EditBrand},

    {
        path: "/dashboard",
        component: Dashboard,
        name: "Dashboard",
        meta: { requiresAuth: true },
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
