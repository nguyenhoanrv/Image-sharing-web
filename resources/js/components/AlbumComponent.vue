<template>
  <div class="container">
    <form
      method="POST"
      enctype="multipart/form-data"
      @submit.prevent="onSubmit"
    >
      <p class="text-success" v-if="success">Created the album successfully</p>
      <div class="form-group">
        <label for="nameofalbum">Name of album</label>
        <input
          type="text"
          class="form-control"
          :class="{ 'is-invalid': errors['name'] }"
          id="nameofalbum"
          v-model="name"
        />
        <span class="text-danger" v-if="errors['name']">
          {{ errors["name"][0] }}
        </span>
      </div>
      <div class="form-group">
        <label for="desofalbum">Desctiption of album</label>
        <textarea
          type="text"
          class="form-control"
          :class="{ 'is-invalid': errors['description'] }"
          id="desofalbum"
          v-model="description"
        />
        <span class="text-danger" v-if="errors['description']">
          {{ errors["description"][0] }}
        </span>
      </div>
      <div class="form-group">
        <label for="categoryofalbum">Category of album</label>
        <select
          type="text"
          class="form-control"
          id="categoryofalbum"
          v-model="category_id"
        >
          <option
            v-for="category in categories"
            :key="category.id"
            :value="category.id"
          >
            {{ category.name }}
          </option>
        </select>
      </div>

      <div class="form-group">
        <label for="imageofalbum">Image of album</label>
        <input
          type="file"
          accept="image/*"
          class="form-control"
          :class="{ 'is-invalid': errors['image'] }"
          id="imageofalbum"
          ref="imageFile"
          @change="onImageChange"
        />
        <span class="text-danger" v-if="errors['image']">
          {{ errors["image"][0] }}
        </span>
      </div>
      <button type="submit" class="btn btn-secondary">Submit</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      name: "",
      description: "",
      image: "",
      category_id: "1",
      categories: [],
      errors: [],
      success: false,
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
          this.success = true;
          console.log(res);
        })
        .catch((err) => {
          this.success = false;
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