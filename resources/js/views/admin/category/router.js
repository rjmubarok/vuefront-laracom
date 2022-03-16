import Addcategory from "./Create.vue";
import BulkCreate from "./BulkCreate.vue";
import ViewCategory from "./View.vue";
import EditCategory from "./Edit.vue";
import Index from "./Index.vue";

const routes = [
    { path: "/admin/category", component: Index, meta: { requiresAuth: true } },
    {
        path: "/admin/category/create",
        component: Addcategory,
        meta: { requiresAuth: true },
    },
    {
        path: "/admin/category/:id",
        component: ViewCategory,
        meta: { requiresAuth: true },
    },
    {
        path: "/admin/category/:id/edit",
        component: EditCategory,
        meta: { requiresAuth: true },
    },
    {
        path: "/admin/category/createbulk",
        component: BulkCreate,
        meta: { requiresAuth: true },
    },
];

export default routes;
