<template>
  <div
    class="modal fade"
    id="exampleModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form enctype="multipart/form-data">
            <div class="form-group">
              <label for="nameofalbum">Name of album</label>
              <input
                type="text"
                class="form-control"
                :class="{ 'is-invalid': errors['name'] }"
                id="nameofalbum"
                v-model="dataAlbum.name"
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
                v-model="dataAlbum.description"
              />
              <span class="text-danger" v-if="errors['name']">
                {{ errors["description"][0] }}
              </span>
            </div>
            <div class="form-group">
              <label for="categoryofalbum">Category of album</label>
              <select
                type="text"
                class="form-control"
                id="categoryofalbum"
                v-model="dataAlbum.category_id"
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
                id="imageofalbum"
                ref="imageFile"
                @change="onImageChange"
              />
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Close
          </button>
          <button
            type="button"
            class="btn btn-primary"
            @click.prevent="onUpdate"
          >
            Save changes
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import swal from "sweetalert";

export default {
  props: {
    dataAlbum: Object,
  },
  data() {
    return {
      categories: [],
      errors: {},
      image: "",
    };
  },
  methods: {
    onImageChange(e) {
      this.image = e.target.files[0];
    },
    onUpdate() {
      const config = {
        header: {
          "Content-Type": "multipart/form-data",
        },
      };
      let formData = new FormData();
      formData.append("name", this.dataAlbum.name);
      formData.append("description", this.dataAlbum.description);
      formData.append("image", this.image);
      formData.append("category_id", this.dataAlbum.category_id);
      formData.append("_method", "put");
      console.log(this.dataAlbum.name);
      axios
        .post("/albums/" + this.dataAlbum.id + "/edit", formData, config)
        .then((res) => {
          this.name = "";
          this.description = "";
          this.$refs.imageFile.value = "";
          this.category_id = "1";
          this.errors = [];
          $("#exampleModal").modal("hide");
          this.$emit("albumUpdated", res);
          swal({
            title: "Good job!",
            text: "Your album is updated!",
            icon: "success",
            button: false,
            timer: 1300,
          });
          console.log(res);
        })
        .catch((err) => {
          this.errors = err.response.data.errors;
          console.log(this.errors);
        });
    },
    onDelete() {
      swal("Are you sure?", {
        icon: warnning,
        dangerMode: true,
        buttons: true,
      });
    },
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
  },
  created() {
    this.getCategories();
  },
};
</script>