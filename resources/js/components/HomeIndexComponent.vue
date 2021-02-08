<template>
  <div class="containerr">
    <header>
      <h1>
        SHARE YOUR IMAGE <br />
        <span>[ Portfolio Gallery ]</span>
      </h1>
    </header>
    <h1 class="new_albums">NEW ALBUMS</h1>

    <div class="containerss">
      <!-- <div
      class="panel active"
      style="
        background-image: url('https://source.unsplash.com/random/?nature');
      "
    >
      <h3>Explore Nature</h3>
    </div> -->
      <div
        class="panel"
        v-for="(slide, i) in data1.data"
        :key="slide.album_image"
        :style="{
          backgroundImage: 'url(' + '/album/' + slide.album_image + ')',
        }"
        :class="{ active: index === i }"
        @click="onClick(i)"
      >
        <div class="content">
          <h3>{{ slide.album_name }}</h3>
          <p>Author: {{ slide.user_name }}</p>
          <a class="btn fourth" :href="'/images/' + slide.album_id + '/view'"
            >View Album</a
          >
        </div>
      </div>
    </div>

    <!-- // following albums -->
    <h1 class="new_albums">FOLLOWING ALBUMS</h1>

    <div class="container2">
      <div class="box">
        <img src="https://source.unsplash.com/1000x800" />
        <span>CSS</span>
      </div>
      <div class="box">
        <img src="https://source.unsplash.com/1000x802" />
        <span>Image</span>
      </div>
      <div class="box">
        <img src="https://source.unsplash.com/1000x804" />
        <span>Hover</span>
      </div>
      <div class="box">
        <img src="https://source.unsplash.com/1000x806" />
        <span>Effect</span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      data1: [],
      data2: [],
      index: 0,
    };
  },
  methods: {
    getAlbum() {
      axios
        .get("/albums/get_new_album")
        .then((res) => {
          this.data1 = res.data;
          console.log(res);
        })
        .catch((err) => {
          console.log(err);
        });

      axios
        .get("/albums/get_following_album")
        .then((res) => {
          this.data2 = res.data;
          console.log(res);
        })
        .catch((err) => {
          console.log(err);
        });
    },
    onClick(i) {
      this.index = i;
    },
  },
  created() {
    this.getAlbum();
  },
};
</script>

<style scoped>
/* //// */

@import url("https://fonts.googleapis.com/css?family=Muli&display=swap");
.containerr {
  width: 100%;
  margin-top: -24px;
  background: #eee;
  overflow-x: hidden;
}
.containerss {
  box-sizing: border-box;
  display: flex;
  width: 90vw;
  justify-content: center;
  align-items: center;
  margin: 0 auto;
  font-family: "Muli", sans-serif;
}

.panel {
  background-size: cover;
  background-position: center center;
  background-repeat: no-repeat;
  height: 60vh;
  border-radius: 50px;
  color: #fff;
  cursor: pointer;
  flex: 0.5;
  margin: 10px;
  position: relative;
  transition: flex 0.7s ease-in;
}

.panel .content {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  position: absolute;
  background-image: linear-gradient(
    to right top,
    #d16ba5,
    #c777b9,
    #ba83ca,
    #aa8fd8,
    #9a9ae1,
    #8aa7ec,
    #79b3f4,
    #69bff8,
    #52cffe,
    #41dfff,
    #46eefa,
    #5ffbf1
  );
  bottom: 0px;
  left: 0px;
  border-bottom-left-radius: 50px;
  border-top-right-radius: 50px;
  opacity: 0;
}

.panel.active {
  flex: 5;
}

.panel.active .content {
  opacity: 1;
  transition: opacity 0.3s ease-in 0.5s;
}
.btn {
  box-sizing: border-box;
  appearance: none;
  background-color: transparent;
  border: 2px solid #e74c3c;
  border-radius: 0.6em;
  color: #e74c3c;
  cursor: pointer;
  display: flex;
  align-self: center;
  font-size: 0.7rem;
  font-weight: 400;
  line-height: 1;
  margin: 10px 20px;
  padding: 0.8em 2.2em;
  text-decoration: none;
  text-align: center;
  text-transform: uppercase;
  font-family: "Montserrat", sans-serif;
  font-weight: 700;
}
.btn:hover,
.btn:focus {
  color: #fff;
  outline: 0;
}
.fourth {
  border-color: #f1c40f;
  color: #fff;
  background-image: linear-gradient(45deg, #f1c40f 50%, transparent 50%);
  background-position: 100%;
  background-size: 400%;
  transition: background 300ms ease-in-out;
}
.fourth:hover {
  background-position: 0;
}

@media (max-width: 480px) {
  .container {
    width: 100vw;
  }

  .panel:nth-of-type(4),
  .panel:nth-of-type(5) {
    display: none;
  }
}

/* //header */

header {
  background-color: #84b4b1;
  color: #fff;
  text-align: center;
  padding: 30px 0 120px;
}
header h1 {
  text-align: center;
  text-transform: uppercase;
  font-size: 65px;
  font-weight: 400;
  letter-spacing: 3px;
  line-height: 0.8;
  padding-top: 50px;
  font-family: "Montserrat", sans-serif;
}
header h1 span {
  text-transform: uppercase;
  letter-spacing: 7px;
  font-size: 25px;
  line-height: 1;
}
header p {
  padding-top: 30px;
}

.new_albums {
  width: 600px;
  margin: 50px auto;
  text-align: center;
  text-transform: uppercase;
  font-size: 30px;
  font-weight: 500;
  letter-spacing: 1px;
  display: grid;
  grid-template-columns: 1fr auto 1fr;
  grid-template-rows: 16px 0;
  grid-gap: 22px;
}
.new_albums::before {
  content: " ";
  display: block;
  border-bottom: 3px solid #ccc;
}
.new_albums::after {
  content: " ";
  display: block;
  border-bottom: 3px solid #ccc;
}

/* // following albums */

.container2 {
  display: flex;
  width: 90vw;
  margin: auto;

  margin-top: -40px;
  margin-bottom: 100px;
  box-sizing: border-box;
  height: 50vh;
}

.box {
  flex: 1;
  overflow: hidden;
  transition: 0.5s;
  margin: 0 2%;
  box-shadow: 0 20px 30px rgba(0, 0, 0, 0.1);
  line-height: 0;
}

.box > img {
  width: 200%;
  height: calc(100% - 10vh);
  object-fit: cover;
  transition: 0.5s;
}

.box > span {
  font-size: 2.5vh;
  display: block;
  text-align: center;
  height: 4vh;
  line-height: 3;
}

.box:hover {
  flex: 1 1 50%;
}
.box:hover > img {
  width: 100%;
  height: 100%;
}
</style>