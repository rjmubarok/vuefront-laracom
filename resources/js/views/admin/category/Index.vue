<template>
  <div>
    <h3 class="card-title">Category</h3>
    <div class="card">
      <div class="card-header d-flex justify-content-between">
        <div v-if="!emtyData()">
          <div class="dropdown">
            <button
              class="btn btn-info btn-sm dropdown-toggle"
              :disabled="!Isselected"
              type="button"
              id="dropdownMenuButton"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
              Action
            </button>
            <div class="dropdown-menu">
              <button
                @click="removeitems(selected)"
                type="button"
                class="dropdown-item text-danger py-1"
              >
                <i class="bx bx-trash me-1"></i>
                Delete
              </button>
              <button
                @click="ChangeStatus(selected, 1)"
                type="button"
                class="dropdown-item text-success py-1"
              >
                <i class="bx bxs-toggle-right me-1"></i>
                Active
              </button>
              <button
                @click="ChangeStatus(selected, 0)"
                type="button"
                class="dropdown-item text-info py-1"
              >
                <i class="bx bx-toggle-left me-1"></i>
                Inactive
              </button>
            </div>
          </div>
        </div>
        <router-link to="/admin/add-category" class="btn btn-primary btn-sm">
          Add Category
        </router-link>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table class="table">
          <thead>
            <tr>
              <th>
                <div class="form-check">
                  <input
                    class="form-check-input"
                    :disabled="emtyData()"
                    type="checkbox"
                    @click="selectAll()"
                    v-model="selectedAll"
                  />
                </div>
              </th>
              <th scope="col">Category Name</th>
              <th scope="col">Image</th>
              <th scope="col">Parent Category</th>
              <th scope="col">Status</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr :key="Category.id" v-for="Category in Categories">
              <th>
                <div class="form-check">
                  <input
                    class="form-check-input"
                    type="checkbox"
                    :value="Category.id"
                    v-model="selected"
                  />
                </div>
              </th>
              <td>{{ Category.name }}</td>
              <td>
                <img :src="fileLink(Category.image)" alt="" width="60px" />
              </td>
              <td>{{ Category.parent }}</td>
              <td>
                <span class="badge" :class="statuscolor(Category.status)">
                  {{ statusname(Category.status) }}</span
                >
              </td>
              <td>
                <div class="dropdown">
                  <button
                    type="button"
                    class="btn p-0 dropdown-toggle hide-arrow"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  >
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu" style="">
                    <router-link
                      :to="`/admin/edit-category/${Category.slug}`"
                      class="dropdown-item text-primary"
                    >
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="16"
                        height="16"
                        fill="currentColor"
                        class="bi bi-eye me-1"
                        viewBox="0 0 16 16"
                      >
                        <path
                          d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"
                        />
                        <path
                          d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"
                        />
                      </svg>
                      View details
                    </router-link>
                    <router-link
                      :to="`/admin/edit-category/${Category.slug}`"
                      class="dropdown-item text-info"
                    >
                      <i class="bx bx-edit-alt me-1"></i> Edit
                    </router-link>
                    <button
                      type="submit"
                      class="dropdown-item text-danger"
                      @click.prevent="remove(Category.id)"
                    >
                      <i class="bx bx-trash me-1"></i>
                      Delete
                    </button>
                  </div>
                </div>
              </td>
            </tr>

            <tr v-if="emtyData()">
              <td colspan="9">
                <h4 class="text-center text-danger">Data Not Found</h4>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
      <div class="card-footer clearfix">
        <paginate
          v-model="page"
          :page-count="20"
          :click-handler="clickCallback"
          :prev-text="'<i class=\'tf-icon bx bx-chevrons-left\'></i>'"
          :prev-class="'page-item prev'"
          :prev-link-class="'page-link'"
          :next-text="'<i class=\'tf-icon bx bx-chevrons-right\'></i>'"
          :next-class="'page-item next'"
          :next-link-class="'page-link'"
          :container-class="'pagination'"
          :page-class="'page-item'"
          :page-link-class="'page-link'"
        />
      </div>
    </div>
    <!-- /.card -->
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "manage",
  data() {
    return {
      page: 1,
      selected: [],
      selectedAll: false,
      Isselected: false,
    };
  },

  mounted() {
    this.$store.dispatch("getCategoriess");
  },
  watch: {
    selected: function (selected) {
      this.Isselected = selected.length > 0;
      this.selectedAll = selected.length == this.Categories.length;
    },
  },
  computed: {
    Categories() {
      return this.$store.getters.categories;
    },
  },
  methods: {
    clickCallback: function (pageNum) {
      console.log(pageNum);
      console.log(this.Categories.length);
    },
    statusname(status) {
      let data = {
        0: "Inactive",
        1: "active",
      };
      return data[status];
    },
    statuscolor(status) {
      let data = {
        0: "bg-danger",
        1: "bg-success",
      };
      return data[status];
    },
    fileLink: function (name) {
      return "uploades/" + name;
    },
    remove(slug) {
      //   console.log(slug);
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .delete("api/category/" + slug)
            .then((response) => {
              this.$store.dispatch("getCategoriess");
            })
            .catch((error) => {
              console.log(error);
            });
          Swal.fire("Deleted!", "Your file has been deleted.", "success");
        }
      });
    },
    emtyData() {
      return this.Categories.length < 1;
    },
    selectAll: function () {
      if (event.target.checked === false) {
        this.selected = [];
      } else {
        this.Categories.forEach((Category) => {
          if (this.selected.indexOf(Category.id)) {
            this.selected.push(Category.id);
          }
        });
      }
    },

    removeitems: function (selected) {
      axios
        .post("/categories/remove-items", { ids: selected })
        .then((response) => {
          Swal.fire(
            "Deleted!",
            response.data.total +
              " " +
              "Category has been deleted Successfully !.",
            "success"
          );
          this.selected = [];
          this.selectAll = false;
          this.Isselected = false;
          this.$store.dispatch("getCategoriess");
        })
        .catch((error) => {});
    },
    ChangeStatus: function (selected, status) {
      let msg = status === 1 ? "Active" : "Inactive";
      axios
        .post("/categories/Change-Status-Active", {
          ids: selected,
          status: status,
        })
        .then((response) => {
          Swal.fire(
            response.data.total + "  Category has been  Successfully " + msg
          );
          this.$store.dispatch("getCategoriess");
          this.selected = [];
          this.selectAll = false;
        });
    },
  },
};
</script>













<style>
</style>

