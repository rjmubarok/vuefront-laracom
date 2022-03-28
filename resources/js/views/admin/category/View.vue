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
        <div class="row">
          <div class="col-md-6">
            <img
              :src="'/uploades/' + category.image"
              :alt="category.name"
              class="img-fluid"
            />
          </div>
          <div class="col-md-6">
            <table class="table table-borderless">
              <tbody>
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
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="card card-body mt-3">
      <h4>Product by Category</h4>
      <product-by-category :id="category.id" />
    </div>
  </div>
</template>

<script>
import ProductByCategory from "../../../components/ProductByCategory.vue";
export default {
  components: { ProductByCategory },
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
