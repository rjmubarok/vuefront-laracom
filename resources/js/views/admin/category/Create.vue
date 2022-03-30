<template>
  <div>
    <h3 class="card-title">Create Category</h3>
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
              <label for="validationDefault02">Parent Category</label>
              <select
                name="parent_id"
                id="parent_id"
                class="form-select"
                v-model="form.parent_id"
              >
                <option value=""></option>
                <option
                  v-for="parent in categories"
                  :key="parent.id"
                  :value="parent.id"
                >
                  {{ parent.name }}
                </option>
              </select>
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
              />
            </div>
            <div class="col-md-8 mb-3">
              <label for="validationDefault02">Image</label>
              <input
                type="file"
                accept="image/*"
                class="form-control"
                id="image"
                :v-model="form.image"
                name="image"
                @change="loadeimage($event)"
              />
            </div>
            <div class="col-md-3">
              <img :src="form.image" alt="" height="70px" class="float-right" />
            </div>

            <div class="form-group row">
              <label for="status" class="col-sm-2 col-form-label">Status</label>
              <div class="col-sm-10">
                <input
                  class="form-check-input"
                  type="radio"
                  value="1"
                  id="active"
                  v-model="form.status"
                />
                <label class="form-check-label me-3" for="active">
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
import { mapGetters } from "vuex";
export default {
  name: "create",
  data: () => ({
    form: new Form({
      name: null,
      parent_id: null,
      description: null,
      status: 1,
      image: null,
    }),
  }),
  mounted() {
    this.$store.dispatch("category/getAll");
  },
  computed: {
    ...mapGetters({
      categories: "category/all",
    }),
  },
  methods: {
    addCategory: function () {
      this.form
        .post("/api/category")
        .then(() => {
          Swal.fire({
            position: "top",
            icon: "success",
            title: "Category added successfully",
            showConfirmButton: false,
            timer: 1500,
          });
          this.$router.push("/admin/category");
        })
        .catch((err) => {
          console.log(err);
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
    return "storage/category/" + name;
  },
};
</script>













<style>
</style>

