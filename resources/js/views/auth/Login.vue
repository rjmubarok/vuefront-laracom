<template>
  <div class="mb-5">
    <div class="card card-body m-auto" style="max-width: 400px">
      <form @submit.prevent="login">
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
            v-model="user.email"
          />
        </div>
        <div class="mb-3">
          <input
            type="password"
            class="form-control"
            placeholder="Password"
            v-model="user.password"
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
export default {
  name: "Login",
  data() {
    return {
      user: {
        email: "",
        password: "",
      },
      errorMessage: "",
      validation: null,
    };
  },
  methods: {
    login() {
      this.$store.dispatch("auth/loginUser", this.user);
    },
  },
};
</script>

<style>
</style>
