<template>
  <div class="all" v-if="!!games">
    <h2 class="main-h2">ゲーム一覧</h2>
    <div class="game" v-for="game in games" :key="game.id">
      <div class="picture">
        <div class="picture2">
          <img :src="game.picture" alt="ゲーム画像" class="game-img" />
        </div>
      </div>
      <div class="latter">
        <span class="game-name">{{ game.name }}</span>
        <div class="char">
          <span class="game-type">タイプ：{{ game.type }}</span>
          <span class="game-genre m">ジャンル：{{ game.genre }}</span>
          <span class="game-url">
            HP：
            <a :href="game.url" class="url" target="_blank" rel="noreferrer nooperner">ゲーム公式HP</a>
          </span>
          <span class="game-description">説明文：{{ description(game.description) }}</span>
          <span class="more">もっと読む</span>
        </div>
      </div>
    </div>
    <Pagination :current-page="currentPage" :last-page="lastPage" />
  </div>
</template>

<script>
import Pagination from "../components/Pagination";
import { win32 } from "path";

export default {
  name: "game",
  components: {
    Pagination
  },
  data() {
    return {
      games: "",
      currentPage: 0,
      lastPage: 0
    };
  },
  props: {
    page: {
      type: Number,
      required: true
    }
  },
  computed: {
    // width() {
    //   return window.innerWidth;
    // }
  },
  methods: {
    async game() {
      const response = await axios.get(`/api/game/?page=${this.page}`);

      // console.log(response.data.data[1].description.length);

      this.games = response.data.data;
      this.currentPage = response.data.current_page;
      this.lastPage = response.data.last_page;
    },
    description(value) {
      return value.length >= 83 ? value.substr(0, 80) + "..." : value;
    },
    handleResize() {
      return window.innerWidth;
    }
  },
  watch: {
    $route: {
      async handler() {
        await this.game();
      },
      immediate: true
    }
  }
  // created() {
  //   window.addEventListener("resize", this.handleResize);
  //   this.handleResize();
  // },
  // destroyed() {
  //   window.removeEventListener("resize", this.handleResize);
  // }
};
</script>


<style lang="sass" scoped>
@import '../../sass/game.scss'
</style>