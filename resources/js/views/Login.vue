<template>
  <div class="mb-5">
    <div class="card card-body m-auto" style="max-width: 400px">
      <form @submit.prevent="submit">
        <h1>Login</h1>
        <div class="alert alert-danger" v-if="validation">
          {{ validation }}
        </div>
        <div class="alert alert-danger" v-else-if="errorMessage">
          {{ errorMessage }}
        </div>
        <div class="mb-3">
          <input
            type="email"
            class="form-control"
            placeholder="Email"
            v-model="form.email"
          />
        </div>
        <div class="mb-3">
          <input
            type="password"
            class="form-control"
            placeholder="Password"
            v-model="form.password"
          />
        </div>
        <div class="mb-3">
          <button class="btn btn-primary" type="submit">Login</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { mapActions } from "vuex";
export default {
  name: "Login",
  /* computed: {
    user: {
      get() {
        return this.$store.state.currentUser.state.user;
      },
    },
  }, */
  data() {
    return {
      user: {
        email: "",
        password: "",
      },
      form: {
        email: "",
        password: "",
      },
      errorMessage: "",
      validation: null,
    };
  },
  methods: {
    ...mapActions({
      signIn: "auth/login",
    }),
    submit() {
      this.signIn(this.form);
    },
    login() {
      this.$store.dispatch("auth/loginUser", this.user);
      /* axios
        .post("/api/login", this.form)
        .then(() => {
          this.$router.push({ name: "Dashboard" });
        })
        .catch((error) => {
          this.errorMessage = error.response.data.message;
          this.validation = error.response.data.errors;
          if (error.response) {
            // The request was made and the server responded with a status code
            // that falls out of the range of 2xx
            console.log(error.response.data);
            //console.log(error.response.status);
            //console.log(error.response.headers);
          } else if (error.request) {
            // The request was made but no response was received
            // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
            // http.ClientRequest in node.js
            console.log(error.request);
          } else {
            // Something happened in setting up the request that triggered an Error
            console.log("Error", error.message);
          }
          console.log(error.config);
        }); */
    },
  },
};
</script>

<style>
</style>
