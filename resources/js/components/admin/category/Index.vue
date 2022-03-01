<template>
  <div class="row pt-3">
    <div class="col-md-8 offset-2">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Category</h3>
          <router-link
            to="/add-category"
            class="btn btn-success btn-sm float-right"
          >
            Add Category</router-link
          >
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
                <td>{{Category.name}}</td>
                <td>{{Category.slug}}</td>
                <td>{{Category.description}}</td>
                <td>{{Category.image}}</td>
                <td>{{Category.parent_id}}</td>
<td>
                    <span class="badge" :class="statuscolor(Category.active)">
                      {{ statusname(Category.active) }}</span
                    >
                  </td>
                <td>
                  <tr>
                    <td class="btn btn-sm btn-info">Edit <br /></td>

                    <td class="btn btn-sm btn-danger">Delete</td>
                  </tr>
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
  methods:{
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
  }
};
</script>













<style>
</style>

