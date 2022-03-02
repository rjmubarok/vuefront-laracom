<template>
  <div>
    <div class="row pt-3">
      <div class="col-md-8 offset-2">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <router-link
              to="/categories"
              class="btn btn-success btn-sm float-right"
              >Category</router-link
            >
            <h3 class="card-title j">Create Category</h3>
          </div>
          <h1>Add category</h1>
          <!-- /.card-header -->
          <div class="card-body">
            <form @submit.prevent="addCategory()" method="post">
              <div class="form-row">
                <div class="col-md-8 mb-3">
                  <label for="validationDefault01">Category Name</label>
                  <input
                    type="text"
                    class="form-control"
                    id="validationDefault01"
                    placeholder="Category Name"
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
                <div class="col-md-8 mb-3">
                  <label for="validationDefault02">Description</label>
                  <input
                    type="text"
                    class="form-control"
                    id="validationDefault02"
                    placeholder="Description"
                    v-model="form.description"
                    name="description"
                    required
                  />
                </div>
                <div class="form-group row">
                  <label for="status" class="col-sm-3 col-form-label"
                    >Status</label
                  >
                  <div class="col-sm-9">
                    <input
                      class="form-check-input"
                      type="radio"
                      value="1"
                      id="active"
                      v-model="form.status"
                    />
                    <label class="form-check-label" for="active">
                      Active
                    </label>
                    <input
                      class="form-check-input ml-4"
                      type="radio"
                      value="0"
                      id="Inactive"
                      v-model="form.status"
                    />
                    <label class="form-check-label ml-5" for="Inactive">
                      Inactive
                    </label>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <button
                  type="submit"
                  :disabled="form.busy"
                  class="btn btn-info"
                >
                  Save Category
                </button>
                <button type="reset" class="btn btn-default float-right">
                  Cancel
                </button>
              </div>
            </form>
          </div>
          <!-- /.card -->

          <!-- /.card -->
        </div>
        <!-- /.col -->

        <!-- /.col -->
      </div>
    </div>
  </div>
</template>

<script>
import Form from "vform";
export default {
  name: "create",
  data: () => ({
    form: new Form({
      name: null,
      description: null,
      status: 1,
    }),
  }),
  methods: {
    addCategory: function () {
      this.form.post("/api/category").then((response) => {
        Swal.fire({
          position: "top",
          icon: "success",
          title: "Your work has been saved",
          showConfirmButton: false,
          timer: 1500,
        });
        this.form.name = null;
        this.form.description = null;
        this.form.status = null;
      });
      //   let test = this;
      //   this.form.post("/api/category").then(function (data) {
      //     Toast.fire({
      //       icon: "success",
      //       title: "Category Added Successfully",
      //     });
      //     toastr.success("Category Added Successfully");
      //     test.form.name = null;
      //     test.form.status = null;

      //     test.$router.push("/categories");
      //   });
    },
  },
  mounted() {
    // this.addCategory();
  },
};
</script>













<style>
</style>

