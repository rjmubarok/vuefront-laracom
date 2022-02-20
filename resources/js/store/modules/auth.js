const state = {
    token: null,
    user: {},
};

const getters = {};
const actions = {
    async login({ dispatch }, credentials) {
        await axios.post("/api/login", credentials).then((response) => {
            if (response.data.token) {
                dispatch("attempt", response.data.token);
                //save the token
                localStorage.setItem("login_token", response.data.token);
            }
        });
    },
    async attempt({ commit }, token) {
        commit("SET_TOKEN", token);

        try {
            await axios.get("auth/me").then((response) => {
                commit("SET_USER", response.data);
            });
        } catch (error) {
            console.log("failed");
        }
    },
    loginUser({}, user) {
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

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
