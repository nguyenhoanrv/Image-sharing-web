<template>
  <div class="container">
    <h1>Multiple File Upload Viewer</h1>
    <form method="POST" @submit.prevent="onSubmit">
      <div>
        <label for="upload">
          <input
            type="file"
            accept=".png, .jpg, .jpeg"
            id="upload"
            multiple
            @change="onImageChange"
            name="file"
          />
          Upload Files
        </label>
      </div>
      <div class="files">
        <h2>Files Selected</h2>

        <ul>
          <li v-for="(image, index) in images" :key="index">
            <span>{{ image.name }}</span>
            <div class="image">
              <img :ref="'image'" />
            </div>
            <img
              @click="removeImage(index)"
              class="trash"
              src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAABmJLR0QA/wD/AP+gvaeTAAABBElEQVQ4je2UvUoDQRRGz5VURq38a7VJb0ALa+s8gD5DGp/Dd7BIldIqhSAidmqnkEfQWIoQUxybCQzr7rJrqx8M3J+5Z+4dmIEKqX31xZ96VvtVdVEDvAYOgBHwmcKrwBnwGBEnZXWdDDAATrPcYQLtFmq+gCN1nMVGEXGVdzNU5yXjNdVcHeYdToHLqvEbagqFO1QvgLWWoI+IOF86ReAM2GwJfI+IraWzUrNxAtwn+yYtUmzS6Ch1ll10Tx0k+zgtU6yX7ZvljLoOf6V/4F8AdmpyG0A32etZvJtypSo+vVdgu2VTbxGxs3SKIz+1hAE8VGbUffVOXTT4AxfqrbqXM74BvLv29LPiQjQAAAAASUVORK5CYII="
            />
            <div class="layout"></div>
          </li>
        </ul>
      </div>
      <progress
        max="100"
        :value.prop="uploadPercentage"
        v-if="isUploading"
      ></progress>
      <input type="submit" value="Submit" name="submit" id="submit" />
    </form>
  </div>
</template>

<script>
export default {
  props: {
    album_id: Number,
  },
  data() {
    return {
      images: [],
      uploadPercentage: 0,
      isUploading: false,
    };
  },
  methods: {
    onImageChange(e) {
      const files = e.target.files;
      this.images.push(...files);
      console.log(this.images);
    },
    removeImage(i) {
      this.images.splice(i, 1);
    },
    onSubmit() {
      this.isUploading = true;
      const config = {
        header: {
          "Content-Type": "multipart/form-data",
        },
        onUploadProgress: (progressEvent) => {
          this.uploadPercentage =
            (progressEvent.loaded * 100) / progressEvent.total;
        },
      };
      let formData = new FormData();
      this.images.map((image, i) => {
        formData.append("images[" + i + "]", image);
      });
      formData.append("album_id", this.album_id);
      console.log(formData);
      axios
        .post("/images/store", formData, config)
        .then((res) => {
          this.images = [];
          this.isUploading = false;
          this.uploadPercentage = 0;
          swal({
            title: "Good job!",
            text: "Your image is uploaded!",
            icon: "success",
            button: false,
            timer: 1300,
          });
        })
        .catch((err) => {
          console.log(err);
        });
      console.log("ok");
    },
  },
  watch: {
    images() {
      for (let i = 0; i < this.images.length; i++) {
        let reader = new FileReader();
        reader.onload = (e) => {
          this.$refs.image[i].src = reader.result;
        };
        reader.readAsDataURL(this.images[i]);
      }
    },
  },
  created() {},
};
</script>
<style  scoped>
* {
  box-sizing: border-box;
}
progress {
  display: block;
  width: 100%;
}
input[type="file"] {
  position: absolute;
  right: -9999px;
  visibility: hidden;
  opacity: 0;
}
input[type="submit"] {
  padding: 1rem 3rem;
  background: #0c8fda;
  display: inline-block;
  text-align: center;
  overflow: hidden;
  border-radius: 10px;
  border: 0;
  color: #fff;
}
input[type="submit"]:hover {
  background: #0b7fc2;
  color: #fff;
  cursor: pointer;
  transition: 0.2s all;
}
label {
  position: relative;
  padding: 1rem 3rem;
  background: #eee;
  display: inline-block;
  text-align: center;
  overflow: hidden;
  border-radius: 10px;
}
label:hover {
  background: #0c8fda;
  color: #fff;
  cursor: pointer;
  transition: 0.2s all;
}
div.files {
  height: auto;
  background: #eee;
  padding: 1rem;
  margin: 1rem 0;
  border-radius: 10px;
}
div.files ul {
  display: flex;
  flex-wrap: wrap;
  list-style: none;
  margin: auto;
}
div.files ul li {
  position: relative;
  max-width: 205px;
  height: auto;
  display: flex;
  flex-direction: column;
  border-radius: 15px;
  background: rgb(253, 253, 253);
  padding: 1rem 0.7rem;
  margin: 0.9rem;
}
div.files ul li span {
  display: inline-block;
  line-height: 100%;
  margin-bottom: 0.3rem;
  text-decoration: underline;
  font-size: 1.2rem;
  width: 100%;
  word-break: break-all;
  border: 2px solid #f8f8f8;
  box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
}
.image img {
  width: 100%;
}
.layout {
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  margin: auto;
  background-color: rgba(0, 0, 0, 0.5);
  border-radius: 15px;
  transition: all 0.4s ease;
  opacity: 0;
  visibility: hidden;
}
.trash {
  position: absolute;
  top: 5px;
  right: 5px;
  padding: 6px;
  cursor: pointer;
  z-index: 10;
  opacity: 0;
  visibility: hidden;
}
div.files ul li:hover .layout,
div.files ul li:hover .trash {
  opacity: 1;
  visibility: visible;
}
/* div.files ul li i {
  cursor: pointer;
  position: absolute;
  top: 50%;
  right: 0;
  transform: translatey(-50%);
} */
div.container {
  width: 100%;
  padding: 0 2rem;
}
span.file-size {
  color: #999;
  padding-left: 0.5rem;
}
</style>
