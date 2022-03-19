<template>
  <div>
    <h3 class="card-title">Create Bulk Category</h3>
    <div class="card">
      <div class="card-header">
        <router-link to="/admin/category" class="btn btn-secondary btn-sm">
          <i class="bx bx-undo"></i>
          Back to Category
        </router-link>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <form
          @submit.prevent="addCategory()"
          method="POST"
          enctype="multipart/form-data"
        >
          <div class="form-row">
            <div class="col-md-8 mb-3">
              <label for="validationDefault01">Category Name</label>
              <textarea
                type="text"
                class="form-control"
                id="validationDefault01"
                placeholder='Category names (separated by comma ",")'
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
              Save Category
            </button>
            <router-link to="/admin/category" class="btn btn-default">
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
    addCategory: function () {
      this.form
        .post("/api/category/createBulk")
        .then((response) => {
          Swal.fire({
            position: "top",
            icon: "success",
            title: "Your work has been saved",
            showConfirmButton: false,
            timer: 1500,
          });
          this.form.name = null;
          //this.$router.push("/admin/category");
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

