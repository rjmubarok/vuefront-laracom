 require("./bootstrap");
import Vue from "vue";
import App from "./App.vue";
import Admin from "./Admin.vue";
import router from "./router";
import store from "./store";
import brand from "./store/modules/brand";
import vendor from "./store/modules/vendor";
// vform
import Form from "vform";
window.Form = Form;
// sweetalert 2
import Swal from "sweetalert2";
window.Swal = Swal;

const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
});
window.Toast = Toast;
// import toastr from 'toastr';
// window.toastr = toastr;

const app = new Vue({
    el: "#app",
    store,
    router,
    brand,
    vendor,
    components: { App, Admin },
});
