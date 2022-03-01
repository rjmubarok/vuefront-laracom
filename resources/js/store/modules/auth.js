import router from "../../router";

const state = {
    token: null,
    user: {},
};

const getters = {
    loggedIn(state) {
        return state.user;
    },
};
const mutations = {
    setUser(state, data) {
        state.user = data;
    },
    setToken(state, token) {
        state.token = token;
    },
};
const actions = {
    getUser({ commit }) {
        axios
            .get("/api/currentUser")
            .then((response) => {
                commit("setUser", response.data);
                window.user = response.data;
            })
            .catch((error) => {
                commit("setUser", {});
                console.log(error);
            });
    },
    loginUser({ commit }, user) {
        axios
            .post("/api/login", user)
            .then((response) => {
                if (response.data.token) {
                    //save the token
                    localStorage.setItem("login_token", response.data.token);
                    commit("setToken", response.data.token);
                    //router.push({ name: "Dashboard" });
                    window.location.href = "dashboard";
                }
            })
            .catch((error) => {
                console.log(error);
            });
    },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
