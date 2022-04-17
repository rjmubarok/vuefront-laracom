import AddBrand from "./Create.vue";
import BulkCreate from "./BulkCreate.vue";
import ViewBrand from "./View.vue";
import EditBrand from "./Edit.vue";
import Index from "./Index.vue";

const routes = [
    { path: "/admin/brand", component: Index, meta: { requiresAuth: true } },
    {
        path: "/admin/brand/create",
        component: AddBrand,
        meta: { requiresAuth: true },
    },
    {
        path: "/admin/brand/createbulk",
        component: BulkCreate,
        meta: { requiresAuth: true },
    },
    {
        path: "/admin/brand/:id",
        component: ViewBrand,
        meta: { requiresAuth: true },
    },
    {
        path: "/admin/brand/:id/edit",
        component: EditBrand,
        meta: { requiresAuth: true },
    },
];

export default routes;
