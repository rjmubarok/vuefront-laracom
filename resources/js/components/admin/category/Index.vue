<template>
  <div class="row pt-3">
    <div class="col-md-8 offset-2">
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <router-link
            to="/add-category"
            class="btn btn-success btn-sm float-right"
          >
            Add Category</router-link
          >
          <h3 class="card-title">Category</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table class="table">
            <thead>
              <tr>
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
                  <router-link
                      :to="`/edit-category/${Category.slug}`"
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

      <!-- /.card -->
    </div>
    <!-- /.col -->

    <!-- /.col -->
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "manage",
  mounted() {
    this.$store.dispatch("getCategoriess");
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
  },
};
</script>













<style>
</style>

