<template>
  <div>
    <div class="card">
      <div class="card-header">
        <router-link to="/admin/category" class="btn btn-secondary btn-sm">
          <i class="bx bx-undo"></i>
          Back to category
        </router-link>
        <router-link
          :to="'/admin/category/' + category.id + '/edit'"
          class="btn btn-info btn-sm"
        >
          <i class="bx bx-edit"></i>
          Edit
        </router-link>
      </div>
      <div class="card-body">
        <table class="table">
          <tr>
            <td>ID</td>
            <td>{{ category.id }}</td>
          </tr>
          <tr>
            <td>Name</td>
            <td>{{ category.name }}</td>
          </tr>
          <tr>
            <td>Slug</td>
            <td>{{ category.slug }}</td>
          </tr>
          <tr>
            <td>Description</td>
            <td>{{ category.description }}</td>
          </tr>

          <tr>
            <td>Parent Category</td>
            <td>{{ category.parent_id }}</td>
          </tr>
          <tr>
            <td>Image</td>
            <td>{{ category.image }}</td>
          </tr>
          <tr>
            <td>Status</td>
            <td>{{ category.status }}</td>
          </tr>
          <tr>
            <td>Created at</td>
            <td>{{ category.created_at }}</td>
          </tr>
          <tr>
            <td>Updated at</td>
            <td>{{ category.updated_at }}</td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Viewcategory",
  data: () => ({
    category: [],
  }),
  methods: {
    getcategory: function () {
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
    this.getcategory();
  },
};
</script>

<style>
</style>
