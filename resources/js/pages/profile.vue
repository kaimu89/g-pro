<template>
  <div class="all" v-if="!!user">
    <h2 class="main-h2">プロフィール</h2>

    <div class="add">
      <div class="photo">
        <div class="picture">
          <img src alt class="user-p p" />
        </div>

        <div class="picture-profile">
          <img src="/logo/0Qp7HbEmWbCY2yZ7xVSgsqpCZp20s5Spi03YNDtt.jpeg" alt class="nanashi-p p" />
        </div>

        <div class="input">
          <form action method="post">
            <input type="file" name="logo" class="file" accept="image/*" />
            <div class="item-5">
              <input type="submit" value="変更する" class="btn" />
            </div>
          </form>
        </div>
      </div>

      <div class="in-btn">
        <div class="flex2">
          <div class="item-1">
            <span class="name">メールアドレス</span>
          </div>
          <div class="item-2">
            <span class="select">{{!!user.email ? user.email : '設定されてません'}}</span>
          </div>
        </div>
        <div class="item-5">
          <router-link to="/profile/email" class="btn">変更する</router-link>
        </div>
      </div>

      <div class="password">
        <div class="item-1">
          <span class="select">パスワード</span>
        </div>
        <div class="item-5">
          <router-link to="/profile/password" class="btn">変更する</router-link>
        </div>
      </div>

      <div class="flex">
        <div class="item-1">
          <span class="name">ユーザー名</span>
        </div>
        <div class="item-2">
          <span class="select">{{user.user_name ? user.user_name : '設定されてません'}}</span>
        </div>
      </div>

      <div class="full-name">
        <div class="item-1">
          <span class="name">姓</span>
          <span class="select">{{user.first_name}}</span>
        </div>
        <div class="item-2">
          <span class="name">名</span>
          <span class="select">{{user.last_name}}</span>
        </div>
      </div>

      <div class="full-name">
        <div class="item-1">
          <span class="name">姓</span>
          <span class="select"></span>
        </div>
        <div class="item-2">
          <span class="name">名</span>
          <span class="select"></span>
        </div>
      </div>

      <div class="flex s">
        <div class="item-1">
          <span class="name">氏名</span>
        </div>
        <div class="item-2">
          <span
            class="select"
          >{{!!(user.first_name && user.last_name) ? user.first_name + user.last_name : '設定されてません'}}</span>
        </div>
      </div>

      <div class="flex">
        <div class="item-1">
          <span class="name" @click="users">性別</span>
        </div>
        <div class="item-2">
          <span class="select">{{user.gender == 0 || 1 ? user.gender : '設定されてません'}}</span>
        </div>
      </div>

      <div class="flex">
        <div class="item-1">
          <span class="name">Twitter</span>
        </div>
        <div class="twitter">
          <span class="at">＠</span>
          <span class="twi">{{user.twitter ? user.twitter : '設定されてません'}}</span>
        </div>
      </div>

      <div class="flex">
        <div class="item-1">
          <span class="name">誕生日</span>
        </div>
        <div class="item-2">
          <span class="select">{{user.birthday ? user.birthday : '設定されてません'}}</span>
        </div>
      </div>

      <div class="item-5 out">
        <router-link to="/profile/edit" class="btn">変更する</router-link>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "profile",
  data() {
    return {
      user: ""
    };
  },
  // computed: {
  //   user() {
  //     return this.$store.getters["auth/user"];
  //   }
  // }
  methods: {
    async users() {
      const response = await axios.get("api/user");

      this.user = response.data;
    }
  },
  watch: {
    $route: {
      async handler() {
        await this.users();
      },
      immediate: true
    }
  }
};
</script>

<style lang="sass" scoped>
@import '../../sass/profileShow.scss'
</style>