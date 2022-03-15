import Addcategory from "./Create.vue";
import ViewCategory from "./View.vue";
import EditCategory from "./Edit.vue";
import Index from "./Index.vue";

const routes = [
    { path: "/admin/category", component: Index, meta: { requireAuth: true } },
    { path: "/admin/category/create", component: Addcategory },
    { path: "/admin/category/:id", component: ViewCategory },
    { path: "/admin/category/:id/edit", component: EditCategory },
];

export default routes;
