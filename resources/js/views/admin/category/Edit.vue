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
            <h3 class="card-title j">Edit Category</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <form
              @submit.prevent="updateCategory()"
              method="POST"
              enctype="multipart/form-data"
            >

              <div class="form-row">
                  {{ this.$route.params.id}}
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
                <input type="hidden" v-model="form.id">
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
                <div class="col-md-8 mb-3">
                  <label for="validationDefault02">Image</label>
                  <input
                    type="file"
                    class="form-control"
                    id="image"
                    :v-model="form.image"
                    name="image"
                    @change="loadeimage($event)"
                  />
                </div>
                <div class="col-md-3">
                  <img
                    :src="form.image"
                    alt=""
                    height="70px"
                    class="float-right"
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
                  Update Category
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
import axios from "axios";
export default {
  name: "edit",
  data: () => ({
    form: new Form({
      id: null,
      name: null,
      description: null,
      status: 1,
      image: null,
    }),
  }),
  mounted() {
    this.getCategory();
  },
  methods: {
    updateCategory: function () {
        var id = this.$route.params.id;
      this.form
        .post('/update-category/')
        .then((response) => {
            console.log(response);
          Swal.fire({
            position: "top",
            icon: "success",
            title: "Update Category Successfully",
            showConfirmButton: false,
            timer: 1500,
          });
          this.$router.push("/categories");
        })
        .catch((err) => {
          console.log(err);
        });
    },
    getCategory: function () {
      var slug = this.$route.params.slug;
      axios
        .get("/api/category/" + slug)
        .then((response) => {
          this.form.fill(response.data.category);
        //   console.log(response.data.category);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    loadeimage: function (e) {
      let test = this;
      let file = e.target.files[0];
      const filereader = new FileReader();
      filereader.onload = function (e) {
        // console.log(e.target.result);
        test.form.image = e.target.result;
      };
      filereader.readAsDataURL(file);
    },
  },
  fileLink: function (name) {
    return "uploades/" + name;
  },
};
</script>













<style>
</style>

