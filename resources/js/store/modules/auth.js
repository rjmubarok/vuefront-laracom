const state = {
    user: {},
};

const mutations = {
    setUser(state, data) {
        state.user = data;
    },
};

const actions = {
    async getUser({ commit }) {
        await axios
            .get("/api/currentUser")
            .then((response) => {
                commit("setUser", response.data);
            })
            .catch((error) => {
                commit("setUser", {});
                console.log(error);
            });
    },
    async loginUser({ commit }, user) {
        await axios
            .post("/api/login", user)
            .then((response) => {
                if (response.data.token) {
                    //save the token
                    localStorage.setItem("login_token", response.data.token);
                    window.location.href = "dashboard";
                }
            })
            .catch((error) => {
                console.log(error);
            });
    },
};
const getters = {
    loggedIn: (state) => !!state.user.name,
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
