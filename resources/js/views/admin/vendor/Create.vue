<template>
<div>
    <div class="row pt-3">
      <div class="col-md-8 offset-2">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <router-link
              to="/admin/vendor"
              class="btn btn-success btn-sm float-right"
              >Vendor</router-link
            >
            <h3 class="card-title">Create Vendor</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <form
              @submit.prevent="AddVendor()"
              method="POST"
              enctype="multipart/form-data"
            >
              <div class="form-row">
                <div class="col-md-8 mb-3">
                  <label for="validationDefault01">User Name</label>
                  <input
                    type="text"
                    class="form-control"
                    id="validationDefault01"
                    placeholder="User Name"
                    v-model="form.username"
                    name="username"
                    required
                    :class="{ 'is-invalid': form.errors.get('username') }"
                  />
                  <div
                    v-if="form.errors.has('username')"
                    v-html="form.errors.get('username')"
                  />
                </div>
              </div>
              <div class="card-footer">
                <button
                  type="submit"
                  :disabled="form.busy"
                  class="btn btn-info"
                >
                  Save Vendor
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
export default {

}
</script>
