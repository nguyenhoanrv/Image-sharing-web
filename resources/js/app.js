/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");
import VueLazyLoad from "vue-lazyload";
import VueSplide from "@splidejs/vue-splide";
import InfiniteLoading from "vue-infinite-loading";
import Vue from "vue";

Vue.use(VueLazyLoad);
Vue.use(VueSplide);
Vue.use(InfiniteLoading);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
    "album-component",
    require("./components/AlbumComponent.vue").default
);
Vue.component(
    "album-index-component",
    require("./components/AlbumIndexComponent.vue").default
);
Vue.component(
    "edit-component",
    require("./components/EditComponent.vue").default
);
Vue.component(
    "home-component",
    require("./components/LoginRegisterComponent.vue").default
);
Vue.component(
    "upload-component",
    require("./components/UploadComponent.vue").default
);
Vue.component(
    "image-index-component",
    require("./components/ImageIndexComponent.vue").default
);
Vue.component(
    "home-index-component",
    require("./components/HomeIndexComponent.vue").default
);
Vue.component(
    "profile-component",
    require("./components/ProfileComponent.vue").default
);
Vue.component(
    "comment-component",
    require("./components/CommentComponent.vue").default
);
Vue.component(
    "notification-component",
    require("./components/NotificationComponent.vue").default
);

Vue.component("light-box", require("vue-image-lightbox").default);
Vue.component("paginate", require("./components/common/Paginate.vue").default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

new Vue({
    el: "#wellcome"
});

new Vue({
    el: "#notifications"
});

const app = new Vue({
    el: "#app"
});
