<template>
  <div>
    <div class="card">
      <div class="card-header">
        <router-link to="/admin/brand" class="btn btn-secondary btn-sm">
          <i class="bx bx-undo"></i>
          Back to brand
        </router-link>
        <router-link
          :to="'/admin/brand/' + brand.id + '/edit'"
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
              :src="'/storage/brand/' + brand.image"
              :alt="brand.name"
              class="img-fluid"
              v-if="brand.image"
            />
            <img
              :src="'/storage/brand/default.png'"
              :alt="brand.name"
              class="img-fluid"
              v-else
            />
          </div>
          <div class="col-md-6">
            <table class="table table-borderless">
              <tbody>
                <tr>
                  <td>ID</td>
                  <td>{{ brand.id }}</td>
                </tr>
                <tr>
                  <td>Name</td>
                  <td>{{ brand.name }}</td>
                </tr>
                <tr>
                  <td>Slug</td>
                  <td>{{ brand.slug }}</td>
                </tr>
                <tr>
                  <td>Description</td>
                  <td>{{ brand.description }}</td>
                </tr>
                <tr>
                  <td>Parent brand</td>
                  <td>{{ brand.parent_id }}</td>
                </tr>
                <tr>
                  <td>Status</td>
                  <td>{{ brand.status }}</td>
                </tr>
                <tr>
                  <td>Created at</td>
                  <td>{{ brand.created_at }}</td>
                </tr>
                <tr>
                  <td>Updated at</td>
                  <td>{{ brand.updated_at }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="card card-body mt-3">
      <h4>Product by brand</h4>
      <product-by-brand :id="brand.id" />
    </div>
  </div>
</template>

<script>
//import ProductBybrand from "../../../components/ProductBybrand.vue";
export default {
 // components: { ProductBybrand },
  name: "Viewbrand",
  data: () => ({
    brand: {},
  }),
  methods: {
    getbrand: function () {
      var id = this.$route.params.id;
      axios
        .get("/api/brand/" + id)
        .then((response) => {
          this.brand = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  mounted() {
    this.getbrand();
  },
};
</script>

<style>
</style>
