<template>
  <table class="table">
    <thead class="h3">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Image</th>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">Category</th>
        <th scope="col">View Album</th>
        <th scope="col">Upload</th>
        <th scope="col">Edit/Delete</th>
      </tr>
    </thead>
    <tbody class="h4">
      <tr v-for="(album, i) in albums" :key="album.id">
        <th scope="row">{{ i + 1 }}</th>
        <td>
          <img
            :src="'/album/' + album.image"
            alt=""
            width="90"
            class="img-fluid"
          />
        </td>
        <td>{{ album.name }}</td>
        <td>{{ album.description }}</td>
        <td>{{ album.category.name }}</td>

        <td>
          <a :href="'/images/' + album.id + '/view'">
            <button class="btn btn-info">View Album</button>
          </a>
        </td>

        <td>
          <a :href="'/images/' + album.id + '/upload'">
            <button class="btn btn-success">Upload</button>
          </a>
        </td>
        <td>
          <button
            type="button"
            class="btn btn-primary"
            data-toggle="modal"
            data-target="#exampleModal"
            @click.prevent="getAlbumById(album.id)"
          >
            Edit
          </button>

          <button
            type="button"
            class="btn btn-danger"
            @click.prevent="onDelete(album.id)"
          >
            Delete
          </button>

          <edit-component
            :dataAlbum="dataAlbum"
            @albumUpdated="albumUpdate"
          ></edit-component>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
import swal from "sweetalert";

export default {
  data() {
    return {
      albums: [],
      dataAlbum: {},
    };
  },
  methods: {
    getAlbums() {
      axios
        .get("/albums/get")
        .then((res) => {
          this.albums = res.data;
          console.log(res.data);
        })
        .catch((err) => {
          console.log(err);
        });
    },
    getAlbumById(id) {
      axios
        .get("api/albums/" + id)
        .then((res) => {
          this.dataAlbum = res.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    albumUpdate(res) {
      this.albums = res.data;
    },
    onDelete(id) {
      swal("Are you sure?", {
        icon: "warning",
        dangerMode: true,
        buttons: true,
      }).then((value) => {
        if (value) {
          axios.delete("albums/" + id + "/delete").then((res) => {
            this.albums = res.data;
            swal({
              title: "Good job!",
              text: "Your album is deleted!",
              icon: "success",
              button: false,
              timer: 1300,
            });
          });
        }
      });
    },
  },
  created() {
    this.getAlbums();
  },
};
</script>
  
<style>
</style>