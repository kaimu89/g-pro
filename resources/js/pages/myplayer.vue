<template>
  <div class="all" v-if="!!player">
    <h2 class="main-h2">選手登録情報</h2>

    <div class="add">
      <div class="flex">
        <div class="item-1">
          <span class="name">IGN</span>
        </div>
        <div class="item-2">
          <span class="select">{{player.ign}}</span>
        </div>
      </div>

      <div class="flex">
        <div class="item-1">
          <span class="name">志望チーム</span>
        </div>
        <div class="item-2">
          <span class="select">{{player.proama}}</span>
        </div>
      </div>

      <div class="flex">
        <div class="item-1">
          <span class="name">ゲームタイトル</span>
        </div>
        <div class="item-2">
          <span class="select">{{game}}</span>
        </div>
      </div>

      <div class="flex">
        <div class="item-1">
          <span class="name">ポジション</span>
        </div>
        <div class="item-2">
          <span class="select">{{position}}</span>
        </div>
      </div>

      <div class="flex">
        <div class="item-1">
          <span class="name">ランク</span>
        </div>
        <div class="item-2">
          <span class="select">{{rank}}</span>
        </div>
      </div>

      <div class="flex">
        <div class="item-1">
          <span class="name">紹介文</span>
        </div>
        <div class="item-2">
          <span class="select">{{player.description}}</span>
        </div>
      </div>

      <div class="item-5 out">
        <router-link to="/myplayer/edit" class="btn">変更する</router-link>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "myplayer",
  data() {
    return {
      player: "",
      game: "",
      position: "",
      rank: ""
    };
  },
  // computed: {
  //   player() {
  //     return this.$store.getters["auth/user"].player;
  //   }
  // }
  methods: {
    async players() {
      const response = await axios.get("/api/user");

      // console.log(response.data.player.game.name);

      this.player = response.data.player;

      this.game = response.data.player.game.name;
      this.position = response.data.player.position.name;
      this.rank = response.data.player.rank.name;
    }
  },
  watch: {
    $route: {
      async handler() {
        await this.players();
      },
      immediate: true
    }
  },
  beforeRouteEnter(route, redirect, next) {
    async function middleware() {
      const response = await axios.get("/api/user");

      const user = response.data;

      // console.log(response.data);

      return !!user.player ? next() : false;
    }

    middleware();
  }
};
</script>

<style lang="sass" scoped>
@import '../../sass/myplayerShow.scss'
</style>