<template>
  <div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <ul class="navbar-nav">
          <li class="nav-item">
            <router-link to="/" class="nav-link" exact="">Home</router-link>
          </li>
          <li class="nav-item">
            <router-link to="/about" class="nav-link">About</router-link>
          </li>
          <li class="nav-item" v-if="authenticated">
            <router-link to="/dashboard" class="nav-link"
              >Dashboard</router-link
            >
          </li>
        </ul>
        <ul class="navbar-nav d-flex">
          <li class="nav-item">
            <router-link to="/login" class="nav-link">Login</router-link>
          </li>
          <li class="nav-item">
            <router-link to="/register" class="nav-link">Register</router-link>
          </li>
        </ul>
      </div>
    </nav>

    <router-view />
  </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  name: "App",
  computed: {
    ...mapGetters({
      authenticated: "auth/authenticated",
      user: "auth/user",
    }),
    loggedIn: {
      get() {
        return this.$store.state.currentUser.loggedIn;
      },
    },
  },
  methods: {
    logout() {
      axios.post("/logout").then((response) => {
        window.location.href = "login";
      });
    },
  },
  /* created() {
    axios.defaults.headers.common["Authorization"] =
      "Bearer " + localStorage.getItem("login_token");
  }, */
};
</script>
