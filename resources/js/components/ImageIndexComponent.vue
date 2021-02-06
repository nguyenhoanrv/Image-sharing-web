!<template>
  <div class="container">
    <h1>{{ album.name }}</h1>
    <div class="stamp-sheet">
      <div
        class="stamp"
        v-for="(image, i) in album.images"
        :key="image.id"
        @click="
          show = true;
          startAt = i;
        "
      >
        <img :src="'/images/albums/' + image.image" />
      </div>
    </div>
    <h3>Description: {{ album.description }}</h3>
    <h3>
      By: <a :href="'/profile/' + album.user.id">{{ album.user.name }}</a>
    </h3>
    <light-box
      :media="media"
      :startAt="startAt"
      v-if="show"
      @onClosed="show = false"
    ></light-box>
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
/*============== CREDITS:=============
          Based on a Pen by Orhan
  "CSS3 Stamp effect using radial gradients"
    https://codepen.io/orhanveli/pen/tbGJL 
           Images from Unsplash
======================================*/

.container {
  background: #bbb;
  min-width: 100%;
  min-height: 100vh;
  margin-top: -24px;
}

h1,
h3 {
  padding: 1em;
}
h1,
h3 {
  margin-left: 15%;
}
div.stamp-sheet {
  max-width: 1320px;
  min-width: 600px;
  margin: 0 auto;
  display: flex;
  flex-wrap: wrap;
}

.stamp {
  width: 220px;
  height: 260px;
  padding: 10px;
  position: relative;
  background: white;
  background: radial-gradient(transparent 4px, white 4px);
  background-size: 20px 20px;
  background-position: -10px -10px;
  transition: ease-in-out 300ms;
  will-change: transform;
}
.stamp img {
  width: 100%;
  height: 100%;
}
div.stamp::before {
  content: "Title";
  color: white;
  font-size: 24px;
  position: absolute;
  left: 26px;
  bottom: 24px;
  text-shadow: 0px 0px 5px rgba(0, 0, 0, 0.8), 0px 0px 2px rgba(0, 0, 0, 0.8);
}

div.stamp::after {
  content: "♞";
  color: white;
  position: absolute;
  top: 10px;
  right: 24px;
  font-size: 66px;
  text-shadow: 0px 0px 5px rgba(0, 0, 0, 0.8), 0px 0px 2px rgba(0, 0, 0, 0.8);
}

.stamp:last-child {
  transform: rotate(7deg);
  transform-origin: bottom left;
}

.stamp:hover {
  z-index: 1;
  transform: rotate(3deg);
  transform-origin: center;
  filter: drop-shadow(0px 0px 10px rgba(0, 0, 0, 0.3));
  transition: ease-in-out 300ms;
}
</style>