<template>
  <body data-theme="default">
    <!-- Wrapper-->
    <div class="comment-wrapper">
      <!-- Theme options-->
      <div class="container">
        <div class="center-block">
          <div class="media-comment" id="comment">
            <a class="avatar-content" :href="'/profile/' + this.user.user_id"
              ><img
                class="avatar"
                :src="'/storage' + this.user.avatar.slice(6)"
                width="70px"
                height="70px"
              />
            </a>
            <form method="POST" @submit.prevent="submitComment($event, par_id)">
              <textarea
                type="text"
                placeholder="Add your comment"
                v-model="comment_content"
                @keydown.enter.exact.prevent
                @keyup.enter.exact.prevent="submitComment"
              />
            </form>
          </div>
          <div
            class="media-comment"
            v-for="(comment, i) in comments"
            :key="comment.comment_par.id"
          >
            <a
              class="avatar-content"
              :href="'/profile/' + comment.comment_par.user_id"
              ><img
                class="avatar"
                :src="'/storage' + comment.comment_par.avatar.slice(6)"
                width="70px"
                height="70px"
              />
            </a>
            <div class="media-content">
              <div class="media-comment-body">
                <div class="media-option">
                  <a
                    class="ripple-grow"
                    href="javascript://"
                    id="dropdownMenuButton"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                    ><svg
                      class="ripple-icon"
                      width="28"
                      height="28"
                      xmlns="http://www.w3.org/2000/svg"
                      xmlns:xlink="http://www.w3.org/1999/xlink"
                      version="1.1"
                      viewBox="0 0 24 24"
                    >
                      <g fill="currentColor">
                        <circle cx="5" cy="12" r="2"></circle>
                        <circle cx="12" cy="12" r="2"></circle>
                        <circle cx="19" cy="12" r="2"></circle>
                      </g></svg
                  ></a>
                </div>
                <div class="media-comment-data-person">
                  <a
                    class="media-comment-name"
                    :href="'/profile/' + comment.comment_par.user_id"
                    >{{ comment.comment_par.user_name }}</a
                  ><span class="text-muted">2 h</span>
                </div>
                <div class="media-comment-text">
                  {{ comment.comment_par.content }}
                </div>
              </div>
              <div class="media-comment-footer">
                <a class="media-footer-option repply" href="javascript://"
                  ><span class="icon-bubble-content"
                    ><svg
                      width="20"
                      height="20"
                      xmlns="http://www.w3.org/2000/svg"
                      xmlns:xlink="http://www.w3.org/1999/xlink"
                      version="1.1"
                      viewBox="0 0 24 24"
                    >
                      <path
                        fill="currentColor"
                        d="M14.046 2.242l-4.148-.01h-.002c-4.374 0-7.8 3.427-7.8 7.802 0 4.098 3.186 7.206 7.465 7.37v3.828c0 .108.044.286.12.403.142.225.384.347.632.347.138 0 .277-.038.402-.118.264-.168 6.473-4.14 8.088-5.506 1.902-1.61 3.04-3.97 3.043-6.312v-.017c-.006-4.367-3.43-7.787-7.8-7.788zm3.787 12.972c-1.134.96-4.862 3.405-6.772 4.643V16.67c0-.414-.335-.75-.75-.75h-.396c-3.66 0-6.318-2.476-6.318-5.886 0-3.534 2.768-6.302 6.3-6.302l4.147.01h.002c3.532 0 6.3 2.766 6.302 6.296-.003 1.91-.942 3.844-2.514 5.176z"
                      ></path></svg></span
                  ><span class="media-footer-option-text">{{
                    comment.comments_child.length
                  }}</span></a
                ><a class="media-footer-option like" href="javascript://"
                  ><span class="icon-bubble-content"
                    ><svg
                      width="20"
                      height="20"
                      xmlns="http://www.w3.org/2000/svg"
                      xmlns:xlink="http://www.w3.org/1999/xlink"
                      version="1.1"
                      viewBox="0 0 24 24"
                    >
                      <path
                        fill="currentColor"
                        d="M12 21.638h-.014C9.403 21.59 1.95 14.856 1.95 8.478c0-3.064 2.525-5.754 5.403-5.754 2.29 0 3.83 1.58 4.646 2.73.814-1.148 2.354-2.73 4.645-2.73 2.88 0 5.404 2.69 5.404 5.755 0 6.376-7.454 13.11-10.037 13.157H12zM7.354 4.225c-2.08 0-3.903 1.988-3.903 4.255 0 5.74 7.034 11.596 8.55 11.658 1.518-.062 8.55-5.917 8.55-11.658 0-2.267-1.823-4.255-3.903-4.255-2.528 0-3.94 2.936-3.952 2.965-.23.562-1.156.562-1.387 0-.014-.03-1.425-2.965-3.954-2.965z"
                      ></path></svg></span
                  ><span class="media-footer-option-text">755</span></a
                >
                <a
                  class="media-footer-option share"
                  href=""
                  @click.prevent="
                    {
                      index = i;
                      comment_child_content = '';
                    }
                  "
                  ><span class="icon-bubble-content"
                    ><svg
                      x="20px"
                      y="0px"
                      viewBox="0 0 511.992 511.992"
                      style="
                        enable-background: new 0 0 511.992 511.992;
                        height: 20px;
                        width: 20px;
                      "
                      xml:space="preserve"
                    >
                      <g>
                        <g>
                          <path
                            d="M239.992,159.998h-48v-80c0-6.624-4.064-12.544-10.208-14.944c-6.144-2.368-13.152-0.704-17.632,4.192l-160,176
			c-5.536,6.08-5.536,15.392,0,21.504l160,176c3.104,3.392,7.424,5.248,11.84,5.248c1.952,0,3.904-0.352,5.792-1.056
			c6.144-2.4,10.208-8.32,10.208-14.944v-80h44.512c91.328,0,179.776,32.704,249.088,92.16c4.704,4.064,11.456,4.992,17.088,2.368
			c5.696-2.592,9.312-8.288,9.312-14.528C511.992,282.014,389.976,159.998,239.992,159.998z M236.504,319.998h-60.512
			c-8.832,0-16,7.168-16,16v54.624L37.624,255.998l122.368-134.624v54.624c0,8.832,7.168,16,16,16h64
			c64.096,0,124.384,24.96,169.696,70.272c37.024,37.024,60.48,84.032,67.808,134.912
			C407.416,347.198,323.16,319.998,236.504,319.998z"
                          />
                        </g>
                      </g></svg></span
                ></a>
              </div>
              <div
                class="media-comment"
                v-for="comment_child in comment.comments_child"
                :key="comment_child.id"
              >
                <a
                  class="avatar-content"
                  :href="'/profile/' + comment_child.user_id"
                  ><img
                    class="avatar"
                    :src="'/storage' + comment_child.avatar.slice(6)"
                    width="55px"
                    height="55px"
                  />
                </a>
                <div class="media-content">
                  <div class="media-comment-body">
                    <div class="media-option">
                      <a
                        class="ripple-grow"
                        href="javascript://"
                        id="dropdownMenuButton"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                        ><svg
                          class="ripple-icon"
                          width="28"
                          height="28"
                          version="1.1"
                          viewBox="0 0 24 24"
                        >
                          <g fill="currentColor">
                            <circle cx="5" cy="12" r="2"></circle>
                            <circle cx="12" cy="12" r="2"></circle>
                            <circle cx="19" cy="12" r="2"></circle>
                          </g></svg
                      ></a>
                    </div>
                    <div class="media-comment-data-person">
                      <a
                        class="media-comment-name"
                        :href="'/profile/' + comment_child.user_id"
                        >{{ comment_child.user_name }}
                      </a>
                      <span class="text-muted">7 h</span>
                    </div>
                    <div class="media-comment-text">
                      {{ comment_child.content }}
                    </div>
                  </div>
                  <div class="media-comment-footer"></div>
                </div>
              </div>
              <div class="media-comment" id="comment" v-if="index === i">
                <a class="avatar-content" :href="'/profile/' + user.user_id"
                  ><img
                    class="avatar"
                    :src="'/storage' + user.avatar.slice(6)"
                    width="55px"
                    height="55px"
                  />
                </a>
                <form method="POST">
                  <textarea
                    type="text"
                    name="content"
                    placeholder="Add your comment"
                    v-model="comment_child_content"
                    @keydown.enter.exact.prevent
                    @keyup.enter.exact.prevent="
                      submitComment($event, comment.comment_par.id)
                    "
                  />
                </form>
              </div>
            </div>
          </div>

          <div class="loading-content">
            <svg
              class="svg-loading"
              version="1.1"
              xmlns="http://www.w3.org/2000/svg"
              xmlns:xlink="http://www.w3.org/1999/xlink"
              x="0px"
              y="0px"
              width="40px"
              height="40px"
              viewBox="0 0 40 40"
              enable-background="new 0 0 40 40"
              xml:space="preserve"
            >
              <path
                opacity="0.2"
                fill="#000"
                d="M20.201,5.169c-8.254,0-14.946,6.692-14.946,14.946c0,8.255,6.692,14.946,14.946,14.946 s14.946-6.691,14.946-14.946C35.146,11.861,28.455,5.169,20.201,5.169z M20.201,31.749c-6.425,0-11.634-5.208-11.634-11.634 c0-6.425,5.209-11.634,11.634-11.634c6.425,0,11.633,5.209,11.633,11.634C31.834,26.541,26.626,31.749,20.201,31.749z"
              ></path>
              <path
                fill="#000"
                d="M26.013,10.047l1.654-2.866c-2.198-1.272-4.743-2.012-7.466-2.012h0v3.312h0 C22.32,8.481,24.301,9.057,26.013,10.047z"
              >
                <animateTransform
                  attributeType="xml"
                  attributeName="transform"
                  type="rotate"
                  from="0 20 20"
                  to="360 20 20"
                  dur="0.5s"
                  repeatCount="indefinite"
                ></animateTransform>
              </path>
            </svg>
          </div>
        </div>
      </div>
    </div>
  </body>
</template>

<script>
export default {
  props: {
    album_id: Number,
    user: Object,
  },
  data() {
    return {
      comments: [],
      comment_content: "",
      comment_child_content: "",
      index: -1,
    };
  },
  methods: {
    submitComment(event, par_id) {
      if (this.comment_content.trim() || this.comment_child_content.trim()) {
        let formData = new FormData();
        formData.append("content", event.target.value);
        formData.append("album_id", this.album_id);
        if (par_id) {
          formData.append("par_id", par_id);
        }
        axios
          .post("/comment/store", formData)
          .then((res) => {
            let data = res.data;
            data.user_name = this.user.name;
            data.avatar = this.user.avatar;
            data.user_id = this.user.id;
            if (par_id) {
              this.comments.map((e) => {
                if (e.comment_par.id === par_id) {
                  e.comments_child.unshift(data);
                  return;
                }
              });
            } else {
              this.comments.unshift({ comment_par: data, comments_child: [] });
            }
            this.comment_content = "";
            this.comment_child_content = "";
            this.par_id = null;
            this.index = -1;
            console.log(res);
          })
          .catch((err) => {
            console.log(err);
          });
      }
    },
    getComment() {
      axios
        .get("/comment", {
          params: {
            album: this.album_id,
          },
        })
        .then((res) => {
          this.comments = res.data;
          console.log(res);
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
  created() {
    this.getComment();
  },
};
</script>

<style>
@import url("https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap");
:root {
  --body-bg: #fff;
  --body-color: #22262a;
  --body-color-hover: #000;
  --footer-social-link-hover-bg: #ededed;
  --media-comment-body-color: #22262a;
  --media-comment-name-color: var(--body-color);
  --muted-color: rgba(4, 5, 6, 0.51);
  --theme-color-blue: #d6ecff;
  --theme-color-red: #fde7e7;
  --theme-color-green: #d6f5d9;
  --theme-color-yellow: #fffbd1;
  --theme-color-pink: #ffd6f9;
  --theme-color-cyan: #d5fbfb;
  --theme-color-violet: #ebe3fc;
}

[data-theme="default"] {
  --media-comment-body-bg: aliceblue;
}

*,
*::before,
*::after {
  box-sizing: border-box;
}
body {
  display: flex;
  flex-direction: column;
  margin: 0;
  font-size: 1rem;
  font-family: "Roboto", sans-serif;
  line-height: 1.5;
  color: var(--body-color);
  background-color: var(--body-bg);
  -webkit-text-size-adjust: 100%;
}
body .footer {
  margin-top: auto;
}
a,
a:link {
  color: var(--body-color);
  text-decoration: none;
  transition: 0.3s linear;
}
a:hover {
  color: var(--body-color-hover);
}
a:focus {
  outline: none;
}
h1,
h2,
h3,
h4,
h5,
h6 {
  margin: 0;
  font-weight: 500;
  line-height: 1.2;
}
h3 {
  font-size: 1.7rem;
  margin-bottom: 0.5rem;
}
h5 {
  font-size: 1.1rem;
}
.container {
  width: 100%;
  padding-right: 15px;
  padding-left: 15px;
  margin-right: auto;
  margin-left: auto;
}
@media screen and (min-width: 576px) {
  .container {
    max-width: 540px;
  }
}
@media screen and (min-width: 768px) {
  .container {
    max-width: 720px;
  }
}
@media screen and (min-width: 992px) {
  .container {
    max-width: 960px;
  }
}
@media screen and (min-width: 1200px) {
  .container {
    max-width: 1140px;
  }
}
.center-block {
  max-width: 100%;
  margin: 0 auto;
}
.addonz-switch {
  z-index: 0;
  position: relative;
  display: inline-block;
}
.addonz-switch > .addonz-switch-input {
  appearance: none;
  z-index: -1;
  position: absolute;
  right: 4px;
  top: -10px;
  display: block;
  margin: 0;
  background-color: #151a20;
  outline: none;
  transform: scale(1);
  pointer-events: none;
  border-radius: 50%;
  width: 45px;
  height: 45px;
  opacity: 0;
  transition: opacity 0.3s, transform 0.2s;
}
.addonz-switch > .addonz-switch-inner {
  display: inline-block;
  width: 100%;
  font-weight: 500;
  cursor: pointer;
}
.addonz-switch > .addonz-switch-inner::before {
  content: "";
  float: right;
  display: inline-block;
  margin: 5px 0 5px 15px;
  border-radius: 7px;
  width: 36px;
  height: 14px;
  background-color: #adb5bd;
  vertical-align: top;
  transition: background-color 0.2s, opacity 0.2s;
}
.addonz-switch > .addonz-switch-inner::after {
  content: "";
  position: absolute;
  top: 2px;
  right: 1rem;
  border-radius: 50%;
  width: 20px;
  height: 20px;
  background-color: white;
  box-shadow: 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 2px 2px 0 rgba(0, 0, 0, 0.14),
    0 1px 5px 0 rgba(0, 0, 0, 0.12);
  transition: background-color 0.2s, transform 0.2s;
}
.addonz-switch > .addonz-switch-input:checked {
  right: -14px;
  background-color: #1c939c;
}
.addonz-switch > .addonz-switch-input:checked + .addonz-switch-inner::before {
  background-color: #1c939c;
}
.addonz-switch > .addonz-switch-input:checked + .addonz-switch-inner::after {
  background-color: #2ab6c0;
  transform: translateX(16px);
}
.addonz-switch:hover > .addonz-switch-input {
  opacity: 0.08;
}
.addonz-switch:hover > .addonz-switch-input:focus {
  opacity: 0.18;
}
.addonz-switch > .addonz-switch-input:focus,
.addonz-switch > .addonz-switch-input.focus {
  opacity: 0.2;
}
.addonz-switch > .addonz-switch-input:active {
  opacity: 1;
  transform: scale(0);
  transition: transform 0s, opacity 0s;
}
.addonz-switch > .addonz-switch-input:active + .addonz-switch-inner::before {
  background-color: #1c939c;
}
.addonz-switch
  > .addonz-switch-input:checked:active
  + .addonz-switch-inner::before {
  background-color: #adb5bd;
}
.addonz-switch > .addonz-switch-input:disabled {
  opacity: 0;
}
.addonz-switch > .addonz-switch-input:disabled + .addonz-switch-inner {
  color: #2ab6c0;
  opacity: 0.7;
  cursor: default;
}
.addonz-switch > .addonz-switch-input:disabled + .addonz-switch-inner::before {
  background-color: rgba(52, 58, 64, 0.994) !important;
}
.addonz-switch
  > .addonz-switch-input:checked:disabled
  + .addonz-switch-inner::before {
  background-color: rgba(52, 58, 64, 0.994) !important;
}
.box-theme-option {
  padding: 1.5rem;
  background-color: rgba(255, 255, 255, 0.039);
  border-radius: 0.8rem;
  margin-bottom: 4rem;
}
.box-theme-option .box-theme-option-inner {
  display: flex;
  flex-direction: column;
}
@media (min-width: 768px) {
  .box-theme-option .box-theme-option-inner {
    justify-content: start;
    align-items: center;
    flex-direction: row;
  }
  .box-theme-option .box-theme-option-inner .addonz-form-inline {
    margin-bottom: 0;
    margin-right: 4rem;
  }
}
.box-theme-option .addonz-form-inline {
  margin-top: -5px;
  margin-bottom: 2rem;
}
.badge-color {
  text-decoration: none;
  width: 2.5rem;
  height: 2.5rem;
  border-radius: 50%;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  margin-right: 1rem;
  background-color: #f8f9fa;
  margin-bottom: 0.8rem;
}
.badge-color .badge-color-icon {
  visibility: hidden;
}
.badge-color.blue {
  background-color: var(--theme-color-blue);
}
.badge-color.red {
  background-color: var(--theme-color-red);
}
.badge-color.green {
  background-color: var(--theme-color-green);
}
.badge-color.yellow {
  background-color: var(--theme-color-yellow);
}
.badge-color.pink {
  background-color: var(--theme-color-pink);
}
.badge-color.cyan {
  background-color: var(--theme-color-cyan);
}
.badge-color.violet {
  background-color: var(--theme-color-violet);
}
.badge-color.active .badge-color-icon {
  visibility: visible;
}
.twtr-emoji {
  position: relative;
  vertical-align: middle;
  top: -0.1rem;
}
.media-comment-body .media-comment-data-person,
.ripple-grow,
.media-comment-footer,
.media-footer-option,
.media-footer-option .icon-bubble-content,
.collapse-repply {
  display: flex;
  align-items: center;
}
.text-muted {
  color: var(--muted-color);
}
.comment-wrapper {
  padding-top: 5rem;
}
.media-comment {
  display: flex;
  align-items: flex-start;
}
.media-comment .avatar-content {
  margin-right: 1rem;
}
.media-comment .avatar-content .avatar {
  border-radius: 50%;
}
.media-content {
  width: 100%;
}
.media-comment-body {
  position: relative;
  display: inline-block;
  padding: 1.2rem;
  background-color: var(--media-comment-body-bg);
  border-radius: 0.8rem;
  padding-right: 3rem;
}
.media-comment-body .media-option {
  position: absolute;
  right: 0.7rem;
  top: 1rem;
  visibility: hidden;
}
.media-comment-body:hover .media-option {
  visibility: visible;
}
.media-comment-body .media-comment-data-person {
  margin-bottom: 0.3rem;
}
.media-comment-body .media-comment-text {
  color: var(--media-comment-body-color);
}
.media-comment-body .media-comment-name {
  color: var(--media-comment-name-color);
  font-size: 1rem;
  font-weight: 600;
  text-transform: inherit;
  line-height: 1.5;
  letter-spacing: 0.0178571em;
  margin-right: 1rem;
}
.ripple-grow {
  width: 2.5rem;
  height: 2.5rem;
  justify-content: center;
  border-radius: 50%;
  color: rgba(0, 0, 0, 0.658) !important;
}
.ripple-grow:hover {
  background-color: rgba(0, 0, 0, 0.122);
  color: #000;
}
.media-comment-footer {
  margin-top: 0.6rem;
  margin-bottom: 1.2rem;
}
.media-footer-option {
  padding: 0 1rem 0 0;
  text-decoration: none;
  transition: all 0.3s;
  color: var(--body-color);
}
.media-footer-option .icon-bubble-content {
  transition: all 0.3s;
  justify-content: center;
  margin-right: 0.4rem;
  border-radius: 50%;
  width: 2.2rem;
  height: 2.2rem;
}
.media-footer-option.repply:hover {
  color: #03c1e2;
}
.media-footer-option.repply:hover .icon-bubble-content {
  background-color: rgba(0, 156, 184, 0.233);
}
.media-footer-option.like:hover {
  color: #cd0aa9;
}
.media-footer-option.like:hover .icon-bubble-content {
  background-color: rgba(215, 9, 178, 0.169);
}
.media-footer-option.share:hover {
  color: #009402;
}
.media-footer-option.share:hover .icon-bubble-content {
  background-color: rgba(0, 179, 3, 0.164);
}
.collapse-repply {
  margin-bottom: 1.5rem;
}
.collapse-repply svg {
  transition: all 0.3s;
  transform: rotate(-180deg);
}
.collapse-repply.active svg {
  transform: rotate(0deg);
}
.loading-content {
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 3rem 0;
  margin-bottom: 5rem;
}
.loading-content path {
  fill: var(--body-color);
}
.footer {
  padding: 2rem 0;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
}
.footer p {
  margin: 0;
  color: var(--body-color);
}
.footer .yo-content {
  margin-bottom: 0.3rem;
  font-weight: 500;
  color: var(--body-color);
}
.footer .yo {
  text-decoration: underline;
}
.footer .footer-social {
  display: flex;
  align-items: center;
}
.footer .footer-social-link {
  color: var(--body-color);
  width: 2.8rem;
  height: 2.8rem;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 4rem;
  transition: 0.3s linear;
}
.footer .footer-social-link:hover {
  color: var(--body-color-hover);
  background-color: var(--footer-social-link-hover-bg);
}
form {
  width: 100%;
}
textarea {
  width: 100%;
  height: auto;
  background-color: #f0f2f5;
  font-size: 18px;
  border: none;
  outline: 0;
  outline-width: 0;
  resize: none;
  padding: 10px 20px 0px 20px;
  border-radius: 30px;
  /* text-align: center; */
  /* line-height: 50px; */
}
textarea::placeholder {
  opacity: 1;
}
/* textarea:focus::placeholder {
  color: transparent;
} */
#comment {
  display: flex;
  justify-content: center;
  align-items: center;
}
#comment {
  margin: 10px 0;
}
</style>