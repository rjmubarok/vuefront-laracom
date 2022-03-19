export default {
    state: {
        category: {},
        categories: [],
    },
    getters: {
        category(state) {
            return state.category;
        },
        categories(state) {
            return state.categories;
        },
    },
    actions: {
        async getAll({ commit }, id) {
            await axios
                .get("/api/category/all/" + id)
                .then((response) => {
                    commit("categories", response.data);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        getCategories({ commit }, page) {
            axios
                .get("/api/category?page=" + page)
                .then((response) => {
                    commit("categories", response.data);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        getCategory({ commit }, id) {
            axios
                .get("/api/category/26")
                .then((response) => {
                    commit("category", response.data);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    mutations: {
        category(state, data) {
            return (state.category = data);
        },
        categories(state, data) {
            return (state.categories = data);
        },
    },
};
