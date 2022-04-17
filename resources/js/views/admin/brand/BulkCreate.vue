<template>
  <div>
    <h3 class="card-title">Create Bulk Brand</h3>
    <div class="card">
      <div class="card-header">
        <router-link to="/admin/brand" class="btn btn-secondary btn-sm">
          <i class="bx bx-undo"></i>
          Back to Brand
        </router-link>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <form
          @submit.prevent="addBrand()"
          method="POST"
          enctype="multipart/form-data"
        >
          <div class="form-row">
            <div class="col-md-8 mb-3">
              <label for="validationDefault01">Brand Name</label>
              <textarea
                type="text"
                class="form-control"
                id="validationDefault01"
                placeholder='Brand names (separated by comma ",")'
                v-model="form.name"
                name="name"
                required
                :class="{ 'is-invalid': form.errors.get('name') }"
              />
              <div
                v-if="form.errors.has('name')"
                v-html="form.errors.get('name')"
              />
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" :disabled="form.busy" class="btn btn-primary">
              Save Brand
            </button>
            <router-link to="/admin/brand" class="btn btn-default">
              Cancel
            </router-link>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import Form from "vform";
export default {
  name: "createBulk",
  data: () => ({
    form: new Form({
      name: null,
    }),
  }),
  methods: {
    addBrand: function () {
      this.form
        .post("/api/brand/bulkcreate")
        .then((response) => {
          Swal.fire({
            position: "top",
            icon: "success",
            title: "Your work has been saved",
            showConfirmButton: false,
            timer: 1500,
          });
          this.form.name = null;
          this.$router.push("/admin/brand");
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>


<style>
</style>

