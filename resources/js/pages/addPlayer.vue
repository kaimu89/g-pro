<template>
  <div class="all" v-if="games">
    <h2 class="main-h2">登録</h2>

    <div class="add">
      <h3 class="title">選手登録</h3>

      <div class="error-pc" v-if="errors.ign">
        <small class="small">※{{errors.ign[0]}}</small>
      </div>
      <div class="flex">
        <div class="item-1">
          <span class="name">IGN：</span>
          <div class="error-mob" v-if="errors.ign">
            <small class="small">※{{errors.ign[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <input type="text" class="select" v-model="createForm.ign" />
        </div>
      </div>

      <div class="error-pc" v-if="errors.proama">
        <small class="small">※{{errors.proama[0]}}</small>
      </div>
      <div class="flex">
        <div class="item-1">
          <span class="name">志望チーム：</span>
          <div class="error-mob" v-if="errors.proama">
            <small class="small">※{{errors.proama[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <label class="radio1">
            プロ
            <input type="radio" value="0" v-model="createForm.proama" />
          </label>
          <span>|</span>
          <label class="radio2">
            一般
            <input type="radio" value="1" v-model="createForm.proama" />
          </label>
        </div>
      </div>

      <div class="error-pc" v-if="errors.game">
        <small class="small">※{{errors.game[0]}}</small>
      </div>
      <div class="flex">
        <div class="item-1">
          <span class="name">ゲームタイトル：</span>
          <div class="error-mob" v-if="errors.game">
            <small class="small">※{{errors.game[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <select class="game select" v-model="createForm.game" @change="positionRank">
            <option value="0">選択して下さい</option>
            <option :value="game.id" v-for="game in games" :key="game.id">{{ game.name }}</option>
          </select>
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
          <select class="position select" v-model="createForm.position">
            <option class="position-0" value="0">選択して下さい</option>
            <option
              v-for="position in position"
              :value="position.id"
              :key="position.id"
            >{{ position.name }}</option>
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
          <select class="rank select" v-model="createForm.rank">
            <option class="rank-0" value="0">選択して下さい</option>
            <option v-for="rank in rank" :key="rank.id" :value="rank.id">{{ rank.name }}</option>
          </select>
        </div>
      </div>

      <div class="error-pc" v-if="errors.description">
        <small class="small">※{{errors.description[0]}}</small>
      </div>
      <div class="flex">
        <div class="item-1">
          <span class="name">紹介文：</span>
          <div class="error-mob" v-if="errors.description">
            <small class="small">※{{errors.description[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <textarea cols="35" rows="10" class="body" v-model="createForm.description"></textarea>
        </div>
      </div>

      <div class="item-5">
        <input type="submit" value="登録" class="btn" @click.prevent="create" />
      </div>
    </div>
  </div>
</template>

<script>
import { gamePR } from "../module/module";
export default {
  name: "addPlayer",
  data() {
    return {
      createForm: {
        ign: "",
        proama: "",
        game: 0,
        position: 0,
        rank: 0,
        description: ""
      },
      errors: "",
      games: this.$store.state.item.item.games,
      positions: this.$store.state.item.item.positions,
      position: "",
      ranks: this.$store.state.item.item.ranks,
      rank: ""
    };
  },

  methods: {
    //使わない----------storeでできた
    // async options() {
    //   const response = await axios.get("/api/option");

    //   console.log(response.data);

    //   this.games = response.data.games;
    //   this.positions = response.data.positions;
    //   this.ranks = response.data.ranks;
    // },
    //---------------
    //PositionRank
    positionRank() {
      const PR = gamePR(this.createForm.game, this.positions, this.ranks);

      // console.log(PR);
      this.createForm.position = 0;
      this.position = PR[0].slice();
      this.createForm.rank = 0;
      this.rank = PR[1].slice();
    },
    async create() {
      const response = await axios.post("/api/add/player", this.createForm);

      // console.log(response);

      if (response.status == 422) {
        this.errors = response.data.errors;
        return;
      }

      if (response.status == 201) {
        this.$router.push("/player");
      }
    }
  },
  //上記同様に
  // watch: {
  //   $route: {
  //     async handler() {
  //       await this.options();
  //     },
  //     immediate: true
  //   }
  // },
  beforeRouteEnter(route, redirect, next) {
    async function middleware() {
      const response = await axios.get("/api/user");

      const user = response.data;

      // console.log(response.data);

      if (!!user.player) {
        return next("/myplayer");
      }
      return next();
    }

    middleware();
  }
};
</script>


<style lang="sass" scoped>
@import '../../sass/add.scss'
</style>