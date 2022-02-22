import router from "../../router";

const state = {
    token: null,
    user: {},
};

const getters = {
    authenticated(state) {
        return state.token && state.user;
    },

    user(state) {
        return state.user;
    },
};
const mutations = {
    SET_TOKEN(state, token) {
        state.token = token;
    },
    SET_USER(state, data) {
        state.user = data;
    },
};
const actions = {
    async login({ dispatch, commit }, credentials) {
        await axios.post("/api/login", credentials).then((response) => {
            if (response.data.token) {
                dispatch("attempt", response.data.token);
                //commit("SET_TOKEN", response.data.token);
                //commit("SET_USER", response.data.user);
                //save the token
                localStorage.setItem("token", response.data.token);
            }
        });
    },
    async attempt({ commit }, token) {
        commit("SET_TOKEN", token);

        try {
            await axios
                .get("authme", {
                    headers: {
                        "Content-Type": "application/json",
                        Authorization: "Bearer " + token,
                    },
                })
                .then((response) => {
                    commit("SET_USER", response.data);
                });
        } catch (error) {
            console.log("failed");
        }
    },
    /* loginUser({}, user) {
        axios
            .post("/api/login", {
                email: user.email,
                password: user.password,
            })
            .then((response) => {
                if (response.data.token) {
                    //save the token
                    localStorage.setItem("login_token", response.data.token);
                }
            });
    }, */
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
