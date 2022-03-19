<template>
  <div>
    <h4>Edit Category</h4>
    <div class="card">
      <div class="card-header">
        <router-link to="/admin/category" class="btn btn-secondary btn-sm">
          <i class="bx bx-undo"></i>
          Back to Category
        </router-link>
      </div>
      <div class="card-body">
        <form
          @submit.prevent="updateCategory()"
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
            <input type="hidden" v-model="form.id" />
            <div class="col-md-8 mb-3">
              <label for="validationDefault02">Parent Category</label>
              <select name="parent_id" id="parent_id" class="form-select">
                <option value=""></option>
                <option
                  v-for="Parent in Categories"
                  :key="Parent.id"
                  :value="Parent.id"
                  :selected="form.parent_id == Parent.id"
                >
                  {{ Parent.name }}
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
              <label for="status" class="col-sm-3 col-form-label">Status</label>
              <div class="col-sm-9">
                <input
                  class="form-check-input"
                  type="radio"
                  value="1"
                  id="active"
                  v-model="form.status"
                />
                <label class="form-check-label" for="active"> Active </label>
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
            <button type="submit" :disabled="form.busy" class="btn btn-info">
              Update Category
            </button>
            <button type="reset" class="btn btn-default float-right">
              Cancel
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import Form from "vform";
export default {
  name: "edit",
  data: () => ({
    form: new Form({
      id: null,
      name: null,
      parent_id: null,
      description: null,
      status: 1,
      image: null,
    }),
  }),
  mounted() {
    this.getCategory();
    this.$store.dispatch("getAll", this.$route.params.id);
  },
  computed: {
    Categories() {
      this.$store.getters.categories;
    },
  },
  methods: {
    updateCategory: function () {
      var id = this.$route.params.id;
      this.form
        .put("/api/category/" + id)
        .then(() => {
          Swal.fire({
            position: "top",
            icon: "success",
            title: "Update Category Successfully",
            showConfirmButton: false,
            timer: 1500,
          });
          this.$router.push("/admin/category");
        })
        .catch((err) => {
          console.log(err);
        });
    },
    getCategory: function () {
      var id = this.$route.params.id;
      axios
        .get("/api/category/" + id)
        .then((response) => {
          this.form.fill(response.data);
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

