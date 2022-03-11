<template>
  <div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow shadow-sm">
      <div class="container-fluid">
        <ul class="navbar-nav">
          <li class="nav-item">
            <router-link to="/admin/dashboard" class="nav-link" v-if="loggedIn">
              Dashboard
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/admin/categories" class="nav-link"
              >Categories</router-link
            >
          </li>
        </ul>
        <ul class="navbar-nav d-flex">
          <li class="nav-item dropdown" v-if="currentUser.name">
            <a
              class="nav-link dropdown-toggle"
              href="#"
              id="navbarDarkDropdownMenuLink"
              role="button"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
              {{ currentUser.name }}
            </a>
            <ul
              class="dropdown-menu dropdown-menu-end"
              aria-labelledby="navbarDarkDropdownMenuLink"
            >
              <li>
                <a class="dropdown-item" href="#logout" @click="logout"
                  >Logout</a
                >
              </li>
            </ul>
          </li>
          <template v-else>
            <li class="nav-item">
              <router-link to="/login" class="nav-link">Login</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/register" class="nav-link"
                >Register</router-link
              >
            </li>
          </template>
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
      loggedIn: "auth/loggedIn",
    }),
    currentUser: {
      get() {
        return this.$store.state.auth.user;
      },
    },
  },
  methods: {
    logout() {
      axios
        .post("/api/logout")
        .then((response) => {
          //delete localstorage
          localStorage.removeItem("login_token");
          //delete authorization
          delete axios.defaults.headers.common["Authorization"];
          //empty user
          this.$store.state.auth.user = null;
          this.$store.state.auth.token = null;
          //redirect to login
          window.location.href = "login";
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  created() {
    axios.defaults.headers.common[
      "Authorization"
    ] = `Bearer ${localStorage.getItem("login_token")}`;
    this.$store.dispatch("auth/getUser");
  },
};
</script>
