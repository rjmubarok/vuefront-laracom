<template>
  <div>Dashboard logged in {{ loggedUser }}</div>
</template>

<script>
export default {
  name: "Dashboard",
  computed: {
    loggedUser() {
      return this.$store.state.auth.user;
    },
  },
};
</script>

<style>
</style>
