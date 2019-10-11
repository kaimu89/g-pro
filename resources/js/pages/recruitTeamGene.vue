<template>
  <div class="all" v-if="!!team">
    <h2 class="main-h2"></h2>

    <div class="add">
      <h3 class="title">一般チーム</h3>

      <div class="flex">
        <div class="item-1">
          <span class="name">チーム名；</span>
        </div>
        <div class="item-2">
          <span class="text">{{team.name}}</span>
        </div>
      </div>

      <div class="flex">
        <div class="item-1">
          <span class="name">ゲームタイトル：</span>
        </div>
        <div class="item-2">
          <span class="text">{{game.name}}</span>
        </div>
      </div>

      <div class="error-pc" v-if="errors.position">
        <small class="small">※{{errors.position[0]}}</small>
      </div>
      <div class="flex">
        <div class="item-1">
          <span class="name">ポジション：</span>
          <div class="error-mob" v-if="errors.position">
            <small class="small">※{{errors.position[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <select name="position" class="select" v-model="createForm.position">
            <option class="position-0" value>未選択</option>
            <option
              v-for="position in positions"
              :key="position.id"
              :value="position.id"
            >{{position.name}}</option>
          </select>
        </div>
      </div>

      <div class="error-pc" v-if="errors.rank">
        <small class="small">※{{errors.rank[0]}}</small>
      </div>
      <div class="flex">
        <div class="item-1">
          <span class="name">ランク：</span>
          <div class="error-mob" v-if="errors.rank">
            <small class="small">※{{errors.rank[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <select name="rank" class="select" v-model="createForm.rank">
            <option class="rank-0" value>未選択</option>
            <option v-for="rank in ranks" :key="rank.id" :value="rank.id">{{rank.name}}</option>
          </select>
        </div>
      </div>

      <div class="error-pc" v-if="errors.description">
        <small class="small">※{{errors.description[0]}}</small>
      </div>
      <div class="flex">
        <div class="item-1">
          <span class="name">備考・募集文：</span>
          <div class="error-mob" v-if="errors.description">
            <small class="small">※{{errors.description[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <textarea
            name="description"
            cols="35"
            rows="10"
            class="body"
            v-model="createForm.description"
          ></textarea>
        </div>
      </div>

      <div class="item-5">
        <input type="submit" value="登録" class="btn" @click.prevent="create" />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "recruitTeamGene",
  data() {
    return {
      createForm: {
        position: "",
        rank: "",
        description: ""
      },
      team: "",
      game: "",
      positions: "",
      ranks: "",
      errors: ""
    };
  },
  methods: {
    async options() {
      const response = await axios.get("/api/recruit/team/gene");

      this.team = response.data.user.team;
      this.game = response.data.teamgame;
      this.positions = response.data.teampositions;
      this.ranks = response.data.teamranks;

      // console.log(response.data);
    },
    async create() {
      const response = await axios.post(
        "/api/recruit/team/gene",
        this.createForm
      );

      // console.log(response.data);

      if (response.status == 422) {
        this.errors = response.data.errors;
        return;
      }

      if (response.status == 201) {
        this.$router.push("/myteam");
      }
    }
  },
  watch: {
    $route: {
      async handler() {
        await this.options();
      },
      immediate: true
    }
  },
  beforeRouteEnter(route, redirect, next) {
    async function middleware() {
      const response = await axios.get("/api/user");

      const user = response.data;

      // console.log(response.data);

      if (!!user.team) {
        if (user.team.proama == "1") {
          if (user.leader == "0") {
            return next();
          } else if (user.leader == null) {
            return next("/myteam");
          }
        }
      }
      return;
    }
    middleware();
  }
};
</script>


<style lang="sass" scoped>
@import '../../sass/recruit.scss'
</style>