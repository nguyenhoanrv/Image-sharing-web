<template>
  <div class="container">
    <header>
      <i class="fa fa-bars" aria-hidden="true"></i>
    </header>
    <main>
      <div class="row">
        <div class="left col-lg-4">
          <div class="photo-left">
            <img class="photo" :src="'/storage' + user.avatar.slice(6)" />
          </div>
          <h4 class="name">{{ user.name }}</h4>
          <p class="info">{{ user.email }}</p>
          <div class="stats row">
            <div class="stat col-xs-4" style="padding-right: 50px">
              <p class="number-stat">{{ followers_count }}</p>
              <p class="desc-stat">Followers</p>
            </div>
            <div class="stat col-xs-4">
              <p class="number-stat">{{ followings_count }}</p>
              <p class="desc-stat">Following</p>
            </div>
            <div class="stat col-xs-4" style="padding-left: 50px">
              <p class="number-stat">{{ user.albums.length }}</p>
              <p class="desc-stat">Uploads</p>
            </div>
          </div>
          <p class="desc">
            Hi ! My name is Jane Doe. I'm a UI/UX Designer from Paris, in
            France. I really enjoy photography and mountains.
          </p>
          <div class="social">
            <i class="fa fa-facebook-square" aria-hidden="true"></i>
            <i class="fa fa-twitter-square" aria-hidden="true"></i>
            <i class="fa fa-pinterest-square" aria-hidden="true"></i>
            <i class="fa fa-tumblr-square" aria-hidden="true"></i>
          </div>
        </div>
        <div class="right col-lg-8">
          <ul class="nav">
            <li
              v-for="(item, i) in list_item"
              :key="i"
              @click="onClickItem(i)"
              :class="{ 'active-item': i === tab }"
            >
              {{ item }}
            </li>
          </ul>
          <span
            class="follow"
            v-if="user.id !== me_id"
            @click="
              follow(user.id, following);
              following = !following;
            "
            v-text="buttonText"
          ></span>

          <!-- albums -->
          <div class="row gallery" v-if="tab === 0">
            <div class="col-md-4" v-for="album in user.albums" :key="album.id">
              <a :href="'/images/' + album.id + '/view'">
                <img :src="'/album/' + album.image"
              /></a>
            </div>
          </div>

          <!-- followers  -->
          <div class="list-wrapper" v-if="tab === 1">
            <ul class="list">
              <li
                class="list-item"
                v-for="follower in followers"
                :key="follower[0].id"
              >
                <div
                  style="display: flex; cursor: pointer"
                  @click="redirectProfile(follower[0].id)"
                >
                  <div>
                    <img
                      :src="'/storage' + follower[0].avatar.slice(6)"
                      class="list-item-image"
                    />
                  </div>
                  <div class="list-item-content">
                    <h4>{{ follower[0].name }}</h4>
                    <p>@...</p>
                  </div>
                </div>
                <input
                  type="checkbox"
                  id="follow"
                  v-model="follower[1]"
                  @click="follow(follower[0].id, follower[1])"
                  v-if="follower[0].id !== me_id"
                />
              </li>
            </ul>
          </div>

          <!-- followings -->
          <div class="list-wrapper" v-if="tab === 2">
            <ul class="list">
              <li
                class="list-item"
                v-for="following_user in followings"
                :key="following_user[0].id"
              >
                <div
                  style="display: flex; cursor: pointer"
                  @click="redirectProfile(following_user[0].id)"
                >
                  <div>
                    <img
                      :src="'/storage' + following_user[0].avatar.slice(6)"
                      class="list-item-image"
                    />
                  </div>
                  <div class="list-item-content">
                    <h4>{{ following_user[0].name }}</h4>
                    <p>@...</p>
                  </div>
                </div>
                <input
                  type="checkbox"
                  id="follow"
                  v-model="following_user[1]"
                  @click="follow(following_user[0].id, following_user[1])"
                  v-if="following_user[0].id !== me_id"
                />
              </li>
            </ul>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script>
export default {
  props: {
    user: Object,
    avatar: String,
    is_following: Boolean,
    followings_count: Number,
    followers_count: Number,
    me_id: Number,
  },
  data() {
    return {
      list_item: ["Albums", "Followers", "Followings"],
      following: true,
      tab: 0,
      followers: [],
      followings: [],
    };
  },
  methods: {
    follow(user_id, is_following) {
      let formData = new FormData();
      formData.append("following_id", user_id);
      formData.append("is_following", is_following);
      axios
        .post("/follow", formData)
        .then((res) => {
          is_following = !is_following;
        })
        .catch((err) => {
          window.location.href = "/login";
          console.log(err);
        });
    },
    onClickItem(i) {
      this.tab = i;
      if (i !== 0) {
        const url = "/" + this.user.id + "/" + this.list_item[i].toLowerCase();
        axios
          .get(url)
          .then((res) => {
            this[this.list_item[i].toLowerCase()] = res.data;
          })
          .catch((err) => {
            console.log(err);
          });
      }
    },
    redirectProfile(id) {
      window.location.href = id;
    },
  },

  computed: {
    buttonText() {
      return this.following ? "Unfollow" : "Follow";
    },
  },

  created() {
    this.following = this.is_following;
  },
};
</script>
<style  scoped>
.container {
  max-width: 1250px;
  margin: auto;
  padding: 0 !important;
  width: 90%;
  background-color: #fff;
  box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1), 0 3px 6px rgba(0, 0, 0, 0.1);
}

header {
  background: #eee;
  background-image: url("https://images.pexels.com/photos/1731427/pexels-photo-1731427.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260");
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
  background-color: red;
  height: 250px;
}

header i {
  position: relative;
  cursor: pointer;
  right: -96%;
  top: 25px;
  font-size: 18px !important;
  color: #fff;
}

@media (max-width: 800px) {
  header {
    height: 150px;
  }

  header i {
    right: -90%;
  }
}

main {
  padding: 20px 20px 0px 20px;
}

.left {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
}

.photo {
  width: 200px;
  height: 200px;
  margin-top: -120px;
  border-radius: 100px;
  border: 4px solid #fff;
}

.active {
  width: 20px;
  height: 20px;
  border-radius: 20px;
  position: absolute;
  right: calc(50% - 70px);
  top: 75px;
  background-color: #ffc107;
  border: 3px solid #fff;
}

@media (max-width: 990px) {
  .active {
    right: calc(50% - 60px);
    top: 50px;
  }
}

.name {
  margin-top: 20px;
  font-weight: 600;
  font-size: 18pt;
  color: #777;
}

.info {
  margin-top: -5px;
  margin-bottom: 5px;
  font-size: 11pt;
  color: #aaa;
}

.stats {
  margin-top: 25px;
  text-align: center;
  padding-bottom: 20px;
  border-bottom: 1px solid #ededed;
}

.number-stat {
  padding: 0px;
  font-size: 14pt;
  font-weight: bold;
  color: #aaa;
}

.desc-stat {
  margin-top: -15px;
  font-size: 10pt;
  color: #bbb;
}

.desc {
  text-align: center;
  margin-top: 25px;
  margin: 25px 40px;
  color: #999;
  font-size: 11pt;
  padding-bottom: 25px;
  border-bottom: 1px solid #ededed;
}

.social {
  margin: 5px 0 12px 0;
  text-align: center;
  display: inline-block;
  font-size: 20pt;
}

.social i {
  cursor: pointer;
  margin: 0 15px;
}

.social i:nth-child(1) {
  color: #4267b2;
}
.social i:nth-child(2) {
  color: #1da1f2;
}
.social i:nth-child(3) {
  color: #bd081c;
}
.social i:nth-child(4) {
  color: #36465d;
}

.right {
  padding: 0 25px 0 25px !important;
}

.nav {
  display: inline-flex;
}

.nav li {
  margin: 40px 30px 0 10px;
  cursor: pointer;
  font-size: 13pt;
  text-transform: uppercase;
  font-weight: 500;
  color: #888;
}

.nav li:hover,
.active-item {
  color: #999;
  border-bottom: 2px solid #999;
}

.follow {
  position: absolute;
  right: 8%;
  top: 35px;
  font-size: 11pt;
  background-color: #42b1fa;
  color: #fff;
  padding: 8px 15px;
  cursor: pointer;
  transition: all 0.4s;
  font-weight: 400;
}

.follow:hover {
  box-shadow: 0 0 15px rgba(0, 0, 0, 0.2), 0 0 15px rgba(0, 0, 0, 0.2);
}

@media (max-width: 990px) {
  .nav {
    display: none;
  }

  .follow {
    width: 50%;
    margin-left: 25%;
    display: block;
    position: unset;
    text-align: center;
  }
}
.gallery {
  margin-top: 35px;
}

.gallery div {
  margin-bottom: 30px;
}

.gallery img {
  box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1), 0 3px 6px rgba(0, 0, 0, 0.1);
  width: auto;
  height: auto;
  cursor: pointer;
  max-width: 100%;
}
.list-wrapper {
  max-width: 600px;
  margin: 50px auto;
}
.list {
  background: #fff;
  border-radius: 2px;
  list-style: none;
  padding: 10px 20px;
}
.list-item {
  display: flex;
  justify-content: space-between;
  align-items: center;

  margin: 10px;
  padding-bottom: 5px;
  padding-top: 5px;
  border-bottom: 1px solid rgba(0, 0, 0, 0.1);
}

.list-item-image {
  border-radius: 50%;
  width: 64px;
  height: 64px;
}
.list-item-content {
  margin-left: 20px;
}
.list-item-content h4,
.list-item-content p {
  margin: 0;
}
.list-item-content h4 {
  margin-top: 10px;
  font-size: 18px;
}
.list-item-content p {
  margin-top: 5px;
  color: #aaa;
}
@-webkit-keyframes follow-animation {
  from {
    background: white;
    color: #3399ff;
    width: 85px;
    left: 50px;
  }
  to {
    background: #2eb82e;
    border-color: #2eb82e;
    color: #ffffff;
    width: 120px;
    left: 35px;
  }
}
@-webkit-keyframes unfollow-animation {
  from {
    background: #2eb82e;
    color: #ffffff;
    width: 120px;
    left: 35px;
  }
  to {
    background: white;
    border-color: #3399ff;
    color: #3399ff;
    width: 85px;
    left: 50px;
  }
}

/* Standard syntax */
@keyframes follow-animation {
  from {
    background: white;
    color: #3399ff;
    width: 85px;
    left: 50px;
  }
  to {
    background: #2eb82e;
    border-color: #2eb82e;
    color: #ffffff;
    width: 120px;
    left: 35px;
  }
}
@keyframes unfollow-animation {
  from {
    background: #2eb82e;
    color: #ffffff;
    width: 120px;
    left: 35px;
  }
  to {
    background: white;
    border-color: #3399ff;
    color: #3399ff;
    width: 85px;
    left: 50px;
  }
}

#follow {
  -webkit-appearance: none;
  outline: none;
}

input:after {
  color: #3399ff;
  font-size: 10pt;
  background-color: #ffffff;
  border: 1px solid;
  border-color: #3399ff;
  border-radius: 3px;

  cursor: hand;
  display: inline-block;
  text-align: center;
  padding: 3px 5px;

  content: "+ Follow";
  -webkit-animation: unfollow-animation 0.3s
    cubic-bezier(0.175, 0.885, 0.32, 1.275);
  -webkit-animation-fill-mode: forwards;
  animation: unfollow-animation 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  animation-fill-mode: forwards;
}

input:checked:after {
  content: "Following";
  -webkit-animation: follow-animation 0.3s
    cubic-bezier(0.175, 0.885, 0.32, 1.275);
  -webkit-animation-fill-mode: forwards;
  animation: follow-animation 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  animation-fill-mode: forwards;
}
</style>