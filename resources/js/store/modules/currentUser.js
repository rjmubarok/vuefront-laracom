const state = {
    user: {},
};

const getters = {};
const actions = {
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
const mutations = {};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
