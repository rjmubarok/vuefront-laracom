export default {
    state: {
        categotyData: [],
    },
    getters: {
        category(state) {
            return state.categotyData;
        },
    },
    actions: {
        async getAll({ commit }, id) {
            await axios
                .get("/api/category/all/" + id)
                .then((response) => {
                    commit("category", response.data);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        getCategories({ commit }, page) {
            axios
                .get("/api/category?page=" + page)
                .then((response) => {
                    commit("category", response.data);
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
            return (state.categotyData = data);
        },
    },
};
