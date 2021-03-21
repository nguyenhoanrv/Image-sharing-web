!<template>
  <div class="containers">
    <light-box
      :media="media"
      :startAt="startAt"
      v-if="show"
      @onClosed="show = false"
    ></light-box>

    <header>
      <h1>
        {{ album.name }} <br />
        <span>[ {{ album.description }} ]</span> <br />
        <span
          >Create By:
          <a :href="'/profile/' + album.user.id">{{ album.user.name }}</a></span
        >
      </h1>
    </header>

    <div id="top"></div>
    <section class="gallery">
      <div class="row">
        <ul>
          <li
            v-for="(image, i) in album.images"
            :key="image.id"
            @click="
              show = true;
              startAt = i;
            "
          >
            <img :src="'/images/albums/' + image.image" />
          </li>
        </ul>
      </div>
      <!-- / row -->
    </section>
  </div>
</template>

<script>
require("vue-image-lightbox/dist/vue-image-lightbox.min.css");

export default {
  props: {
    album: Object,
  },
  data: () => {
    return {
      media: [],
      startAt: 0,
      show: false,
    };
  },
  created() {
    console.log(this.album);
    let mapping = {
      image: "src",
    };
    this.album.images.map((image) => {
      this.media.push(
        Object.keys(image).reduce((acc, key) => {
          acc[mapping[key]] = image[key];
          return acc;
        }, {})
      );
    });
    this.media.map((e) => {
      e.src = "/images/albums/" + e.src;
      e.thumb = e.src;
    });
    console.log(this.media);
  },
};
</script>

<style scoped>
.album-name {
  min-width: 800px;
  max-width: 1320px;
  max-height: 500px;
  object-fit: cover;
  margin: 3rem 20%;
}
.containers {
  width: 100%;
  margin-top: -24px;
}
* {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}
*:before,
*:after {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}

.row {
  width: 100%;
  max-width: 1170px;
  margin: 0 auto;
  padding: 0;
  clear: both;
}
.row img {
  cursor: pointer;
  max-width: 100%;
  height: 280px;
  width: 370px;
  object-fit: cover;
  padding: 0;
  margin: 0;
}

.gallery ul li {
  float: left;
  margin: 0 0.8771929825%;
  overflow: hidden;
}

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

.gallery {
  padding: 40px 0 20px;
  position: relative;
  overflow: hidden;
}
.gallery ul {
  padding-top: 50px;
  position: relative;
}
.gallery ul li {
  margin-bottom: 20px;
  width: 23.2456140351%;
  position: relative;
}
.gallery ul li a {
  display: block;
  position: relative;
  width: 100%;
  height: 100%;
  margin: 0;
  padding: 0;
  line-height: 0;
}
.row.flex {
  display: flex;
  flex-direction: column;
}
</style>