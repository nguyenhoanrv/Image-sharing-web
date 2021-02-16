<template>
  <div class="row mr-auto">
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-body">
            <div
              class="row dataTables_wrapper d-flex justify-content-between mb-4"
            >
              <div class="col-sm-12 col-md-4">
                <div class="dataTables_length d-flex">
                  <label class="card-title">Show entries</label>
                  <select
                    name="datatable_length"
                    class="custom-select custom-select-sm form-control form-control-sm form-select form-select-sm"
                    v-model="count"
                    @change="getAlbums(1)"
                  >
                    <option value="5">5</option>
                    <option value="15">15</option>
                    <option value="50">50</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-12 col-md-4">
                <div class="dataTables_filter d-flex">
                  <label class="card-title">Search:</label
                  ><input
                    type="search"
                    class="form-control form-control-sm"
                    placeholder="Enter name of album..."
                    v-model="search"
                    @input="getAlbums(1)"
                  />
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-hover mb-0">
                <thead class="h4">
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
                <tbody class="h5">
                  <tr v-for="(album, i) in albums.data" :key="album.id">
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
                    </td>
                  </tr>
                  <edit-component
                    :dataAlbum="dataAlbum"
                    @albumUpdated="getAlbums(albums.current_page)"
                  ></edit-component>
                </tbody>
              </table>
            </div>
            <paginate
              :total="albums.total"
              :total_page="albums.last_page"
              :per_page="albums.per_page"
              @paginate="getAlbums"
            ></paginate>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import swal from "sweetalert";
import Paginate from "./common/Paginate.vue";

export default {
  components: { Paginate },
  data() {
    return {
      albums: {},
      dataAlbum: {},
      count: 5,
      search: "",
    };
  },
  methods: {
    getAlbums(page) {
      axios
        .get("/albums/get", {
          params: {
            page: page,
            count: this.count,
            name: this.search.trim(),
          },
        })
        .then((res) => {
          this.albums = res.data;
          console.log(this.albums);
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

    onDelete(id) {
      swal("Are you sure?", {
        icon: "warning",
        dangerMode: true,
        buttons: true,
      }).then((value) => {
        if (value) {
          axios.delete("albums/" + id + "/delete").then((res) => {
            this.albums.data = res.data;
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
    this.getAlbums(1);
  },
  mounted() {},
};
</script>
  
<style>
table {
  table-layout: fixed;
  width: 100%;
}

table td {
  word-wrap: break-word; /* All browsers since IE 5.5+ */
}
div.row.mr-auto {
  margin-top: -35px;
}
</style>