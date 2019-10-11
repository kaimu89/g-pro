<template>
  <div class="all" v-if="!!teams">
    <h2 class="main-h2">チーム一覧</h2>
    <div class="flex">
      <div class="team" v-for="team in teams" :key="team.id">
        <img :src="team.picture" alt="チーム画像" class="team-img" />
        <span class="team-name">
          <a :href="team.hp" class="team-link">[{{ team.name }}]</a>
        </span>
        <div class="image-all">
          <img
            :src="teamgame.game.picture"
            alt="ゲーム画像"
            class="icon-picture"
            v-for="teamgame in team.teamgames"
            :key="teamgame.id"
          />
        </div>
      </div>
    </div>
    <Pagination :current-page="currentPage" :last-page="lastPage" />
  </div>
</template>

<script>
import Pagination from "../components/Pagination";

export default {
  name: "team",
  components: {
    Pagination
  },
  data() {
    return {
      teams: "",
      currentPage: 0,
      lastPage: 0
    };
  },
  props: {
    page: {
      type: Number,
      required: false,
      default: 1
    }
  },
  // computed: {
  //   teams() {
  //     return this.$store.getters["item/teams"];
  //   }
  // }
  methods: {
    async team() {
      const that = this;

      const response = await axios.get(`/api/team/?page=${this.page}`);

      // console.log(response);

      // .catch(function(e) {
      //   if (e.response.status == 401) {
      //     that.$router.push("/");
      //   }
      // });

      this.teams = response.data.data;
      this.currentPage = response.data.current_page;
      this.lastPage = response.data.last_page;
    }
  },
  watch: {
    $route: {
      async handler() {
        await this.team();
      },
      immediate: true
    }
  }
};
</script>

<style lang="sass" scoped>
@import '../../sass/team.scss'
</style>
