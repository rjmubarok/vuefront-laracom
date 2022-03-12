<template>
  <div>
    <div class="card">
      <div class="card-header d-flex justify-content-between">
        <h3 class="card-title">Category</h3>
        <router-link to="/add-category" class="btn btn-primary">
          Add Category</router-link
        >
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table class="table">
          <thead>
            <tr>
              <th>
                <input
                  :disabled="emtyData()"
                  type="checkbox"
                  @click="selectAll()"
                  v-model="selectedAll"
                />
              </th>
              <th scope="col">ID</th>
              <th scope="col">Category Name</th>
              <th scope="col">Slug</th>
              <th scope="col">Description</th>
              <th scope="col">Image</th>
              <th scope="col">Parent ID</th>
              <th scope="col">Status</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr :key="Category.id" v-for="(Category, index) in Categories">
              <th>
                <input
                  type="checkbox"
                  :value="Category.id"
                  v-model="selected"
                />
              </th>
              <th scope="row">{{ ++index }}</th>
              <td>{{ Category.name }}</td>
              <td>{{ Category.slug }}</td>
              <td>{{ Category.description }}</td>
              <td>
                <img :src="fileLink(Category.image)" alt="" width="60px" />
              </td>
              <td>{{ Category.parent_id }}</td>
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
                    <a class="dropdown-item" href="javascript:void(0);"
                      ><i class="bx bx-edit-alt me-1"></i> Edit</a
                    >
                    <a class="dropdown-item" href="javascript:void(0);"
                      ><i class="bx bx-trash me-1"></i> Delete</a
                    >
                  </div>
                </div>
                <router-link
                  :to="`/admin/edit-category/${Category.slug}`"
                  class="btn btn-sm btn-info"
                >
                  Edit</router-link
                >
                <button
                  type="submit"
                  class="btn btn-sm btn-danger"
                  @click.prevent="remove(Category.id)"
                >
                  Delete
                </button>
              </td>
            </tr>
            <tr v-if="!emtyData()">
              <td colspan="2">
                <div class="dropdown">
                  <button
                    class="btn btn-info dropdown-toggle"
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
                      class="dropdown-item btn btn-sm btn-danger"
                    >
                      Remove
                    </button>
                    <button
                      @click="ChangeStatus(selected, 1)"
                      type="button"
                      class="dropdown-item btn btn-sm btn-danger"
                    >
                      Active
                    </button>
                    <button
                      @click="ChangeStatus(selected, 0)"
                      type="button"
                      class="dropdown-item btn btn-sm btn-danger"
                    >
                      Inactive
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
        <ul class="pagination pagination-sm m-0 float-right">
          <li class="page-item"><a class="page-link" href="#">«</a></li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item"><a class="page-link" href="#">»</a></li>
        </ul>
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

