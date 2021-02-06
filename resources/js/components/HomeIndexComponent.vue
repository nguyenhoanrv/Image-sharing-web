<template>
  <div>
    <h1 class="c-title">Inspiration For Your <br />Next Vacation</h1>
    <ul class="c-featurette">
      <li class="c-featurette__item">
        <img
          class="c-featurette__background"
          src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/911489/steve-long-607673-unsplash.jpg"
        /><small class="c-featurette__category">Summer</small>
        <h2 class="c-featurette__heading">Bali</h2>
        <button class="c-featurette__button">Discover</button>
      </li>
      <li class="c-featurette__item">
        <img
          class="c-featurette__background"
          src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/911489/mario-klassen-428384-unsplash.jpg"
        /><small class="c-featurette__category">Africa</small>
        <h2 class="c-featurette__heading">Kenya</h2>
        <button class="c-featurette__button">Discover</button>
      </li>
      <li class="c-featurette__item">
        <img
          class="c-featurette__background"
          src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/911489/nicolas-j-leclercq-785256-unsplash.jpg"
        /><small class="c-featurette__category">Popular</small>
        <h2 class="c-featurette__heading">Iceland</h2>
        <button class="c-featurette__button">Discover</button>
      </li>
      <li class="c-featurette__item">
        <img
          class="c-featurette__background"
          src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/911489/jonathan-gallegos-727409-unsplash.jpg"
        /><small class="c-featurette__category">Summer</small>
        <h2 class="c-featurette__heading">Greece</h2>
        <button class="c-featurette__button">Discover</button>
      </li>
      <li class="c-featurette__item">
        <img
          class="c-featurette__background"
          src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/911489/yunqing-leo-783078-unsplash.jpg"
        /><small class="c-featurette__category">City</small>
        <h2 class="c-featurette__heading">Arizona</h2>
        <button class="c-featurette__button">Discover</button>
      </li>
    </ul>
  </div>
</template>

<script>
export default {};
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css?family=Playfair+Display:900|Poppins:300,500");
body {
  overflow-x: hidden;
}
* {
  box-sizing: border-box;
}
.c-title {
  position: relative;
  text-align: center;
  font-size: 2.5em;
  margin: 32px 0;
  padding: 32px 0 0 0;
  font-family: "Playfair Display", serif;
  font-weight: 900;
}
.c-title::before {
  content: "";
  display: block;
  position: absolute;
  height: 6px;
  width: 64px;
  left: 50%;
  top: 10px;
  transform: translatex(-50%);
  background: #f7e195;
}
.c-featurette {
  display: flex;
  flex-flow: row nowrap;
  list-style: none;
  margin: 0;
  padding: 0 8px;
  width: 100%;
  height: 100%;
  align-items: center;
}
.c-featurette__item {
  position: relative;
  display: flex;
  flex-flow: column nowrap;
  justify-content: flex-end;
  flex: 1 1 auto;
  margin: 16px 8px;
  min-height: 512px;
  color: #fff;
  font-family: "Poppins", sans-serif;
  letter-spacing: 2px;
  text-align: center;
  border-radius: 2px;
  transition: 250ms ease;
}
.c-featurette__item::before {
  content: "";
  position: absolute;
  display: block;
  height: 100%;
  width: 100%;
  left: 0;
  top: 0;
}
.c-featurette__item::after {
  content: "";
  z-index: -2;
  opacity: 0;
  position: absolute;
  display: none;
  height: 100%;
  width: 100%;
  left: 32px;
  top: 32px;
  background-image: radial-gradient(circle 1px at 0 0, #c2c2c2, transparent 1px),
    radial-gradient(circle 1px at 15px 0, #c2c2c2, transparent 1px),
    radial-gradient(circle 1px at 15px 15px, #c2c2c2, transparent 1px),
    radial-gradient(circle 1px at 0 15px, #c2c2c2, transparent 1px);
  background-size: 16px 16px;
  background-repeat: repeat;
  transition: 250ms ease;
}
.c-featurette__item:nth-child(1)::before {
  background: linear-gradient(0deg, #c63, transparent 35%);
}
.c-featurette__item:nth-child(2)::before {
  background: linear-gradient(0deg, #b9ac8b, transparent 35%);
}
.c-featurette__item:nth-child(3)::before {
  background: linear-gradient(0deg, #2e2e2d, transparent 35%);
}
.c-featurette__item:nth-child(4)::before {
  background: linear-gradient(0deg, #bdcadb, transparent 35%);
}
.c-featurette__item:nth-child(5)::before {
  background: linear-gradient(0deg, #532252, transparent 35%);
}
.c-featurette__item:hover {
  flex: 4 0 auto;
  box-shadow: 0 16px 32px 0 rgba(51, 51, 51, 0.25);
}
.c-featurette__item:hover::after {
  display: block;
  opacity: 1;
}
.c-featurette__item:hover .c-featurette__category {
  transform: translatey(-104px);
  transition: transform 500ms ease;
}
.c-featurette__item:hover .c-featurette__heading {
  transform: translatey(-104px);
  transition: transform 500ms ease 85ms;
}
.c-featurette__item:hover .c-featurette__button {
  display: block;
  opacity: 1;
  transition: opacity 350ms ease 300ms;
}
.c-featurette__background {
  position: absolute;
  width: 100%;
  height: 100%;
  object-fit: cover;
  z-index: -1;
  border-radius: 2px;
}
.c-featurette__category {
  text-transform: uppercase;
  font-weight: 500;
  transition: transform 500ms ease;
  z-index: 1;
}
.c-featurette__heading {
  margin: 8px 0 24px;
  font-size: 2.25em;
  text-shadow: 1px 1px rgba(51, 51, 51, 0.5);
  transition: transform 500ms ease;
  z-index: 1;
}
.c-featurette__button {
  position: absolute;
  left: 24px;
  bottom: 16px;
  width: calc(100% - 94px);
  opacity: 0;
  padding: 24px 0;
  font-family: "Poppins", sans-serif;
  text-transform: uppercase;
  margin: 0 24px 24px;
  background: #f7e195;
  border: none;
  border-radius: 2px;
  font-weight: 700;
  letter-spacing: 2px;
  font-size: 0.85em;
  transition: opacity 150ms ease;
}
</style>