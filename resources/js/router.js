import Vue from "vue";
import VueRouter from "vue-router";
import Home from "./views/Home";
import About from "./views/About";
import Login from "./views/Login";
import Register from "./views/Register";
import Dashboard from "./views/Dashboard";
import NotFound from "./views/NotFound";
import Category from "./components/admin/category/Index.vue"
import Addcategory from "./components/admin/category/Create.vue"
import EditCategory from "./components/admin/category/Edit.vue"
Vue.use(VueRouter);
const routes = [
    { path: "*", component: NotFound },
    { path: "/login", component: Login },
    { path: "/register", component: Register },
    { path: "/", component: Home },
    { path: "/about", component: About },
    { path: "/dashboard", component: Dashboard, name: "Dashboard" },
    { path: "/categories", component:Category},
    { path: "/add-category", component:Addcategory},
    { path: '/edit-category/:id', component:EditCategory},
];

const router = new VueRouter({
    //history: createWebHistory(),
    mode: "history",
    linkActiveClass: "active",
    routes,
});

export default router;
