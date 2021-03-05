<template>
  <div class="dropdown d-inline-block">
    <button
      type="button"
      class="btn header-item noti-icon waves-effect"
      id="page-header-notifications-dropdown"
      data-bs-toggle="dropdown"
      aria-haspopup="true"
      aria-expanded="false"
    >
      <i class="bx bx-bell bx-tada"></i>
      <span class="badge bg-danger rounded-pill" v-if="notifications.length">{{
        notifications.length
      }}</span>
    </button>
    <div
      class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
      aria-labelledby="page-header-notifications-dropdown"
    >
      <div class="p-3">
        <div class="row align-items-center">
          <div class="col">
            <h6 class="m-0" key="t-notifications">Notifications</h6>
          </div>
          <div class="col-auto">
            <a href="#!" class="small" key="t-view-all"> View All</a>
          </div>
        </div>
      </div>
      <div
        data-simplebar
        style="max-height: 300px; overflow-y: scroll"
        v-html="html"
      ></div>
      <div class="p-2 border-top d-grid">
        <a
          class="btn btn-sm btn-link font-size-14 text-center"
          href="javascript:void(0)"
        >
          <i class="mdi mdi-arrow-right-circle me-1"></i>
          <span key="t-view-more">View More...</span>
        </a>
      </div>
    </div>
  </div>
</template>

<script>
const NOTIFICATION_TYPES = {
  follow: "App\\Notifications\\UserFollowed",
  comment: "App\\Notifications\\CommentNotification",
  reply_comment: "App\\Notifications\\ReplyCommentNotification",
};

export default {
  data() {
    return {
      notifications: [],
      html: "",
    };
  },
  methods: {
    makeRouteNotification(notification) {
      var to = `?read=${notification.id}`;
      if (notification.type === NOTIFICATION_TYPES.follow) {
        to = `profile/${notification.data.follower_id}` + to;
      } else {
        to = `images/${notification.data.album_id}/view` + to;
      }
      return "/" + to;
    },
    makeTimeText(time_create) {
      let timeText = "0 minutes ago";

      if (time_create) {
        let time = Math.floor(
          (Date.now() - Date.parse(time_create)) / 1000 / 60 - 7 * 60
        );
        if (time < 60) {
          timeText = time + " minutes ago";
        } else if (time >= 60 && time < 60 * 24) {
          time = Math.floor(time / 60);
          timeText = time + " hours ago";
        } else if (time >= 60 * 24 && time < 60 * 24 * 30) {
          time = Math.floor(time / 60 / 24);
          timeText = time + " days ago";
        } else if (time >= 60 * 24 * 30 && time < 60 * 24 * 365) {
          time = Math.floor(time / 60 / 24 / 30);
          timeText = time + " months ago";
        } else {
          timeText = Math.floor(time / 60 / 24 / 365) + " years ago";
        }
      }

      return timeText;
    },
    makeNotificationText(notification) {
      let text;
      if (notification.type === NOTIFICATION_TYPES.follow) {
        text = `<strong>${notification.data.follower_name}</strong> followed you`;
      } else if (notification.type === NOTIFICATION_TYPES.comment) {
        text = `<strong>${notification.data.user_name}</strong> commented on the album <strong>${notification.data.album_name}</strong> of <strong> ${notification.data.author_name}</strong>`;
      } else if (notification.type === NOTIFICATION_TYPES.reply_comment) {
        text = `<strong>${notification.data.user_name}</strong> replied to <strong>${notification.data.par_name}</strong> on the album <strong>${notification.data.album_name}</strong> of <strong> ${notification.data.author_name}</strong>`;
      }
      let timeText = this.makeTimeText(notification.created_at);
      let route = this.makeRouteNotification(notification);
      this.html =
        `<a href="${route}" class="text-reset notification-item">
          <div class="media"><img
              src="${"/storage" + notification.data.avatar.slice(6)}"
              class="me-3 rounded-circle avatar-xs"
              alt="user-pic"
            /><div class="media-body"> 
        <div class="font-size-13 text-muted">
          <p class="mb-1" key="t-${notification.id}">
            ${text}
          </p>
          <p class="mb-0">
            <i class="mdi mdi-clock-outline"></i>
            <span key="t-hours-ago">${timeText}</span>
          </p>
        </div>
      </div></div></a>` + this.html;
    },
    getNotifications() {
      axios
        .get("/notifications")
        .then((res) => {
          this.notifications = res.data;
          console.log(res.data);
          this.notifications.map((e) => {
            e.data = JSON.parse(e.data);
            this.makeNotificationText(e);
          });
          console.log(this.notifications);
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
  mounted() {
    this.getNotifications();
    var channel = window.Echo.channel(`private-App.User.${window.userId}`);
    channel.listen(
      ".Illuminate\\Notifications\\Events\\BroadcastNotificationCreated",
      (data) => {
        data = { ...data, data: { ...data } };
        this.makeNotificationText(data);
        this.notifications.push(data);
      }
    );
  },
};
</script>

<style>
</style>