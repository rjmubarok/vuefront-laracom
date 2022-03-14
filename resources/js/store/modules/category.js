export default {
    state: {
        categotyData: [],
    },
    getters: {
        categories(state) {
            return state.categotyData;
        },
    },
    actions: {
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
    },
    mutations: {
        categories(state, data) {
            return (state.categotyData = data);
        },
    },
};
