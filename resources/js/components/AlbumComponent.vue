<template>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div
          class="page-title-box d-sm-flex align-items-center justify-content-between"
        >
          <h4 class="mb-sm-0 font-size-18">Create New</h4>

          <div class="page-title-right">
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item">
                <a href="javascript: void(0);">Albums</a>
              </li>
              <li class="breadcrumb-item active">Create New</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- end page title -->

    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title mb-4">Create New Album</h4>
            <form
              method="POST"
              enctype="multipart/form-data"
              @submit.prevent="onSubmit"
            >
              <div class="row mb-4">
                <label for="projectname" class="col-form-label col-lg-2"
                  >Album Name</label
                >
                <div class="col-lg-10">
                  <input
                    id="projectname"
                    v-model="name"
                    :class="{ 'is-invalid': errors['name'] }"
                    type="text"
                    class="form-control"
                    placeholder="Enter Project Name..."
                  />
                  <div class="invalid-feedback" v-if="errors['name']">
                    {{ errors["name"][0] }}
                  </div>
                </div>
              </div>
              <div class="row mb-4">
                <label for="projectdesc" class="col-form-label col-lg-2"
                  >Album Description</label
                >
                <div class="col-lg-10">
                  <textarea
                    class="form-control"
                    id="projectdesc"
                    v-model="description"
                    :class="{ 'is-invalid': errors['description'] }"
                    rows="3"
                    placeholder="Enter Album Description..."
                  ></textarea>
                  <div class="invalid-feedback" v-if="errors['description']">
                    {{ errors["description"][0] }}
                  </div>
                </div>
              </div>

              <div class="row mb-4">
                <label for="category" class="col-form-label col-lg-2"
                  >Category</label
                >
                <div class="col-lg-10">
                  <select
                    class="form-select"
                    id="category"
                    required=""
                    v-model="category_id"
                    :class="{ 'is-invalid': errors['category_id'] }"
                  >
                    <option selected="" disabled="" value="">Choose...</option>
                    <option
                      v-for="category in categories"
                      :key="category.id"
                      :value="category.id"
                    >
                      {{ category.name }}
                    </option>
                  </select>
                  <div class="invalid-feedback" v-if="errors['category_id']">
                    {{ errors["category_id"][0] }}
                  </div>
                </div>
              </div>
              <div class="row mb-4">
                <label for="imageofalbum" class="col-form-label col-lg-2"
                  >Image</label
                >
                <div class="col-lg-10">
                  <input
                    type="file"
                    accept="image/*"
                    class="form-control"
                    :class="{ 'is-invalid': errors['image'] }"
                    id="imageofalbum"
                    ref="imageFile"
                    @change="onImageChange"
                  />
                  <div class="invalid-feedback" v-if="errors['image']">
                    {{ errors["image"][0] }}
                  </div>
                </div>
              </div>
            </form>

            <div class="row justify-content-end">
              <div class="col-lg-10">
                <button
                  type="submit"
                  class="btn btn-primary"
                  @click.prevent="onSubmit"
                >
                  Create Album
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      name: "",
      description: "",
      image: "",
      category_id: "",
      categories: [],
      errors: [],
    };
  },
  methods: {
    getCategories() {
      axios
        .get("/api/categories")
        .then((response) => {
          // handle success
          this.categories = response.data;
          // console.log(this);
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        });
    },
    onImageChange(e) {
      this.image = e.target.files[0];
    },
    onSubmit() {
      const config = {
        header: {
          "Content-Type": "multipart/form-data",
        },
      };
      let formData = new FormData();
      formData.append("name", this.name);
      formData.append("description", this.description);
      formData.append("image", this.image);
      formData.append("category_id", this.category_id);
      console.log(formData);
      axios
        .post("/albums/store", formData, config)
        .then((res) => {
          this.name = "";
          this.description = "";
          this.$refs.imageFile.value = "";
          this.category_id = "1";
          this.errors = [];
          swal({
            title: "Good job!",
            text: "Your album is created!",
            icon: "success",
            button: false,
            timer: 1300,
          });
          window.location.href = "/albums/";
          console.log(res);
        })
        .catch((err) => {
          this.errors = err.response.data.errors;
          console.log(this.errors);
        });
    },
  },
  created() {
    this.getCategories();
  },
};
</script>
  
<style>
</style>