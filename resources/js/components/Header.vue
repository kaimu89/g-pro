<template>
  <div class="header" @mouseleave="display=false">
    <h1 class="header-h1">
      <router-link to="/" class="homelink">G-pro</router-link>
    </h1>

    <div class="app-bell">
      <i class="far fa-bell"></i>
      <i class="fas fa-exclamation-circle"></i>
    </div>
    <div class="font" @click="menu = !menu">
      <i class="fa fa-bars fa-2x"></i>
    </div>

    <div class="modalbox">
      <div class="modal" v-if="menu" @click="menu = false"></div>

      <div class="app-noti none">
        <div class="noti m">
          <span class="noti-l">まだ通知はありません</span>
        </div>
      </div>

      <nav class="app" v-if="menu">
        <ul class="i-menu-second">
          <li class="i-menu-list use" v-if="!!user" @click="my = !my">
            <span class="i-link">{{user.user_name}}</span>
          </li>
          <li class="i-menu-list r3" v-if="!!user && my" @click="menu = false">
            <small>
              <router-link to="profile" class="i-link">プロフィール</router-link>
            </small>
          </li>

          <li class="i-menu-list r3" v-if="!!user && !!user.player && my" @click="menu = false">
            <small>
              <router-link to="myplayer" class="i-link">選手登録情報</router-link>
            </small>
          </li>

          <li
            class="i-menu-list r3"
            v-if="!!user && (!!user.team_id || !!user.child_id) && my"
            @click="menu = false"
          >
            <small>
              <router-link to="/myteam" class="i-link">マイチーム</router-link>
            </small>
          </li>

          <li class="i-menu-list r3" v-if="!!user && my" @click="menu = false">
            <small>
              <router-link to class="i-link">設定</router-link>
            </small>
          </li>
          <li class="i-menu-list r3" v-if="!!user && my" @click="menu = false">
            <small>
              <span class="i-link" @click="logout">ログアウト</span>
            </small>
          </li>

          <li class="i-menu-list" v-if="!user" @click="menu = false">
            <router-link class="i-link" to="/login">ログイン</router-link>
          </li>

          <li class="i-menu-list" @click="menu = false">
            <router-link class="i-link" to="/team">チーム一覧</router-link>
          </li>
          <li class="i-menu-list" @click="menu = false">
            <router-link class="i-link" to="/game">ゲーム一覧</router-link>
          </li>
          <li class="i-menu-list" @click="menu = false">
            <router-link class="i-link" to="/player">プレイヤーを探す</router-link>
          </li>
          <li class="i-menu-list" @click="menu = false">
            <router-link class="i-link" to="/findteam">チームを探す</router-link>
          </li>

          <li class="i-menu-list regi" @click="register = !register">
            <span class="i-link" v-if="!!user">登録</span>
            <router-link to="/login" class="i-link" v-else @click="menu = false">登録</router-link>
          </li>

          <li class="i-menu-list r1" v-show="!!user && register" @click="menu = false">
            <small class="re-list">
              <router-link class="i-link" to="/add/player">選手登録</router-link>
            </small>
          </li>

          <li class="i-menu-list r1" v-if="!!user && register" @click="menu = false">
            <small class="re-list">
              <router-link class="i-link" to="/add/team">チーム登録</router-link>
            </small>
          </li>

          <li class="i-menu-list recr" @click="recruit = !recruit">
            <span class="i-link" v-if="!!user && !!user.team_id">募集</span>
            <router-link
              to="/add/team"
              class="i-link"
              v-if="!!user && !user.team_id"
              @click="menu = false"
            >募集</router-link>
            <router-link to="/login" class="i-link" v-if="!user" @click="menu = false">募集</router-link>
          </li>

          <li
            class="i-menu-list r2"
            v-if="!!user && proama=='0' && user.leader=='0' && recruit"
            @click="menu = false"
          >
            <small class="re-list">
              <router-link class="i-link" to="/recruit/team/pro">プロ選手募集</router-link>
            </small>
          </li>

          <li
            class="i-menu-list r2"
            v-if="!!user && proama==1 && user.leader=='0' && recruit"
            @click="menu = false"
          >
            <small class="re-list">
              <router-link class="i-link" to="/recruit/team/gene">一般選手募集</router-link>
            </small>
          </li>

          <li
            class="i-menu-list r2"
            v-if="!!user && proama != null && user.leader=='0' && recruit"
            @click="menu = false"
          >
            <small class="re-list">
              <router-link class="i-link" to="/recruit/staff">スタッフ募集</router-link>
            </small>
          </li>

          <li class="i-menu-list" @click="menu = false">
            <router-link class="i-link" to="/contact">お問い合わせ</router-link>
          </li>
        </ul>
      </nav>
    </div>

    <nav class="pc">
      <ul class="homenav">
        <li class="navmenu">
          <router-link to="/team" class="homelink">チーム一覧</router-link>
        </li>
        <li class="navmenu">
          <router-link to="/game" class="homelink">ゲーム一覧</router-link>
        </li>
        <li class="navmenu">
          <router-link to="/player" class="homelink">ﾌﾟﾚｲﾔｰを探す</router-link>
        </li>
        <li class="navmenu">
          <router-link to="/findteam" class="homelink">チームを探す</router-link>
        </li>
        <li class="navmenu">
          <span class="homelink" v-if="!!user">登録</span>
          <router-link class="homelink" to="/login" v-else>登録</router-link>
          <ul class="menu_second" v-if="!!user">
            <li class="menu_second_list">
              <router-link to="/add/player" class="menu_second_a">選手登録</router-link>
            </li>
            <li class="menu_second_list">
              <router-link to="/add/team" class="menu_second_a">チーム登録</router-link>
            </li>
          </ul>
        </li>
        <li class="navmenu">
          <span class="homelink" v-if="!!user && !!user.team_id">募集</span>
          <router-link class="homelink" to="/myteam" v-if="!!user && !!user.child_id">募集</router-link>
          <router-link
            class="homelink"
            to="/add/team"
            v-if="!!user && !user.child_id && !user.team_id"
          >募集</router-link>
          <router-link class="homelink" to="/login" v-if="!user">募集</router-link>
          <ul class="menu_second" v-if="!!user">
            <li class="menu_second_list" v-if="proama=='0' && user.leader=='0'">
              <router-link to="/recruit/team/pro" class="menu_second_a">プロ選手募集</router-link>
            </li>
            <li class="menu_second_list" v-if="proama==1 && user.leader=='0'">
              <router-link to="/recruit/team/gene" class="menu_second_a">一般選手募集</router-link>
            </li>
            <li class="menu_second_list" v-if="proama!=null  && user.leader=='0'">
              <router-link to="/recruit/staff" class="menu_second_a">スタッフ募集</router-link>
            </li>
          </ul>
        </li>
        <li class="navmenu">
          <router-link to="/contact" class="homelink">お問い合わせ</router-link>
        </li>
      </ul>
    </nav>
    <div class="pc-bell" @click="notice = !notice">
      <i class="far fa-bell"></i>
      <i class="fas fa-exclamation-circle"></i>
    </div>

    <div class="pc-notice" v-show="notice">
      <div class="pc-noti">
        <div class="noti m">
          <span class="noti-l">まだ通知はありません</span>
        </div>
        <!-- <div class="noti m">
          <span class="noti-l">{{notices}}からスカウトが来ました</span>
        </div>-->
      </div>
    </div>
    <div class="user" @click="display = !display" v-show="isLogin">
      <span class="u">{{ user.user_name }}</span>
      <i class="fa fa-caret-down"></i>
    </div>

    <div class="login" v-show="!isLogin">
      <router-link to="/login" class="log-link">Login</router-link>
    </div>

    <div class="u-box" v-show="display">
      <ul class="u-menu">
        <li class="u-list" @click="display=false">
          <router-link to="/profile" class="u-link">プロフィール</router-link>
        </li>
        <li class="u-list" @click="display=false" v-if="!!user.player">
          <router-link to="/myplayer" class="u-link">選手登録情報</router-link>
        </li>
        <li class="u-list" @click="display=false" v-if="!!user.team_id || !!user.child_id">
          <router-link to="/myteam" class="u-link">マイチーム</router-link>
        </li>
        <li class="u-list" @click="display=false">
          <router-link to="/" class="u-link">設定</router-link>
        </li>
        <li class="u-list" @click="display=false">
          <span class="u-link" @click="logout">ログアウト</span>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import { mapState, mapGetters } from "vuex";

export default {
  data() {
    return {
      notice: false,
      display: false,
      menu: false,
      my: false,
      register: false,
      recruit: false
    };
  },
  computed: {
    ...mapState({
      apiStatus: state => state.auth.apiStatus
    }),
    ...mapGetters({
      isLogin: "auth/check",
      proama: "auth/proama",
      notices: "auth/notices"
    }),
    user() {
      return this.$store.getters["auth/user"];
    }
  },
  methods: {
    async logout() {
      // const response = await axios.post("/logout");

      await this.$store.dispatch("auth/logout");

      if (this.apiStatus) {
        this.$router.push("/");
      }
    }
  },
  watch: {
    menu: function() {
      if (this.menu == false) {
        this.my = false;
        this.register = false;
        this.recruit = false;
      }
    },
    my: function() {
      if (this.my == true) {
        this.register = false;
        this.recruit = false;
      }
    },
    register: function() {
      if (this.register == true) {
        this.my = false;
        this.recruit = false;
      }
    },
    recruit: function() {
      if (this.recruit == true) {
        this.my = false;
        this.register = false;
      }
    }
  }
};
</script>
