<template>
  <div class="mb-5">
    <div class="card card-body m-auto" style="max-width: 400px">
      <h1>Login</h1>
      <div class="mb-3">
        <input
          type="email"
          class="form-control"
          placeholder="Email"
          v-model="form.username"
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
        <button class="btn btn-primary" type="submit" @click.prevent="login">
          Login
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "Login",
  data() {
    return {
      form: {
        username: "",
        password: "",
      },
    };
  },
  methods: {
    login() {
      axios
        .post("/api/login", this.form)
        .then((response) => {
          console.log(response);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>

<style>
</style>
