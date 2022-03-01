<template>
  <div>
    <div class="row pt-3">
      <div class="col-md-8 offset-2">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Category</h3>
            <router-link
              to="/categories"
              class="btn btn-success btn-sm float-right"
            >
              Category</router-link
            >
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <h1>add category</h1>
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
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "Categories",
};
</script>













<style>
</style>

