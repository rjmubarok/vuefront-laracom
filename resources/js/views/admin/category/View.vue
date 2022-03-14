<template>
  <div>
    <div class="card">
      <div class="card-header">
        <router-link to="/admin/category" class="btn btn-secondary btn-sm">
          <i class="bx bx-undo"></i>
          Back to Category
        </router-link>
      </div>
      <div class="card-body">
        {{ category }}
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "ViewCategory",
  data: () => ({
    category: [],
  }),
  methods: {
    getCategory: function () {
      var id = this.$route.params.id;
      axios
        .get("/api/category/" + id)
        .then((response) => {
          this.category = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  mounted() {
    this.getCategory();
  },
};
</script>

<style>
</style>
