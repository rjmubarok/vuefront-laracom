<template>
  <div class="row">
    <div class="col-md-8">
      <div class="card card-body">
        <div>
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Slug</th>
                  <th>Description</th>
                  <th>Parent</th>
                  <th class="text-end">Action</th>
                </tr>
              </thead>
              <tbody :class="{ loading }">
                <tr v-for="category in categories" :key="category.id">
                  <td>
                    <b>{{ category.name }}</b>
                  </td>
                  <td>{{ category.slug }}</td>
                  <td>{{ category.description }}</td>
                  <td>{{ category.parent }}</td>
                  <td class="text-end">
                    <div class="dropdown">
                      <a
                        href="#"
                        data-bs-toggle="dropdown"
                        class="btn btn-light rounded btn-sm font-sm"
                      >
                        <i class="material-icons md-more_horiz"></i>
                      </a>
                      <div class="dropdown-menu">
                        <a
                          class="dropdown-item"
                          href="#"
                          v-on:click="viewCategory(category.id)"
                          >View detail</a
                        >
                        <a
                          class="dropdown-item"
                          href="#"
                          v-on:click="editCategory(category.id)"
                          >Edit info</a
                        >
                        <a
                          class="dropdown-item text-danger"
                          href="#"
                          v-on:click="deleteCategory(category.id)"
                          >Delete</a
                        >
                      </div>
                    </div>
                    <!-- dropdown //end -->
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card card-body">
        <div class="mb-4">
          <label for="name" class="form-label">Category Name</label>
          <input
            type="text"
            class="form-control"
            id="name"
            name="name"
            placeholder="Type here"
            v-model="name"
          />
        </div>
        <div class="mb-4">
          <label for="parent" class="form-label">Parent Category</label>
          <select name="parent" id="parent" class="form-select">
            <option value="">Select Parent Category</option>
            <option
              v-for="category in categories"
              :key="category.id"
              :value="category.id"
            >
              {{ category.name }}
            </option>
          </select>
        </div>
        <div class="mb-4">
          <label class="form-label" for="description">Description</label>
          <textarea
            placeholder="Type here"
            class="form-control"
            id="description"
            name="description"
          ></textarea>
        </div>
        <div class="d-grid">
          <button class="btn btn-primary" v-on:click="createCategory()">
            Create category
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      loading: true,
      categories: [],
      category: null,
      name: "",
    };
  },

  mounted() {
    this.loadCategories();
  },

  methods: {
    loadCategories: function () {
      axios
        .get("/api/category")
        .then((response) => {
          this.categories = response.data;
          this.loading = false; //should set at the end all data fetching
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    createCategory: function () {
      axios
        .post("/api/category", { name: this.name })
        .then((response) => {
          console.log(response.data);
          this.name = "";
          this.categories = response.data;
          this.loadCategories();
        })
        .catch((error) => {
          console.log(error);
        });
    },
    viewCategory: function (id) {
      axios
        .get("/api/category/" + id)
        .then((response) => {
          this.category = response.data;
          this.name = response.data.name;
          console.log(response.data);
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    editCategory: (id) => {
      console.log(id);
    },
    deleteCategory: (id) => {
      console.log(id);
    },
  },
};
</script>
