<template>
  <div class="all" v-if="!!team">
    <h2 class="main-h2"></h2>

    <div class="add">
      <h3 class="title">プロチーム</h3>

      <div class="flex">
        <div class="item-1">
          <span class="name">チーム名：</span>
        </div>
        <div class="item-2">
          <span class="text">{{team.name}}</span>
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
          <select name="game" class="game select" v-model="createForm.game" @change="positionRank">
            <option value>選択して下さい</option>
            <option
              v-for="teamgame in teamgames"
              :value="teamgame.game.id"
              :key="teamgame.game.id"
            >{{ teamgame.game.name }}</option>
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
          <select name="position" class="position select" v-model="createForm.position">
            <option class="position-0" value>選択して下さい</option>
            <option
              :value="position.id"
              v-for="position in position"
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
          <select name="rank" class="rank select" v-model="createForm.rank">
            <option class="rank-0" value>選択して下さい</option>
            <option :value="rank.id" v-for="rank in rank" :key="rank.id">{{ rank.name }}</option>
          </select>
        </div>
      </div>

      <div class="error-pc" v-if="errors.age">
        <small class="small">※{{errors.age[0]}}</small>
      </div>
      <div class="flex">
        <div class="item-1">
          <span class="name">年齢：</span>
          <div class="error-mob" v-if="errors.age">
            <small class="small">※{{errors.age[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <select name="age" class="select" v-model="createForm.age">
            <option value selected>選択して下さい</option>
            <option v-for="(age,index) in ages" :key="index" :value="index">{{age}}</option>
          </select>
        </div>
      </div>

      <div class="error-pc" v-if="errors.house">
        <small class="small">※{{errors.house[0]}}</small>
      </div>
      <div class="flex">
        <div class="item-1">
          <span class="name">ゲーミングハウス：</span>
          <div class="error-mob" v-if="errors.house">
            <small class="small">※{{errors.house[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <label class="radio1">
            あり
            <input type="radio" name="house" value="0" v-model="createForm.house" />
          </label>
          <span>|</span>
          <label class="radio2">
            なし
            <input type="radio" name="house" value="1" v-model="createForm.house" />
          </label>
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
import { gamePR } from "../module/module";
export default {
  name: "recruitTeamPro",
  data() {
    return {
      createForm: {
        game: "",
        position: "",
        rank: "",
        age: "",
        house: "",
        description: ""
      },
      team: "",
      players: [],
      teamgames: [],
      game: "",
      positions: [],
      position: "",
      ranks: [],
      rank: "",
      ages: "",
      errors: ""
    };
  },
  methods: {
    async options() {
      const response = await axios.get("/api/recruit/team/pro");

      // console.log(response.data);

      this.team = response.data.user.team;
      this.teamgames = response.data.teamgames;
      this.positions = this.$store.state.item.item.positions;
      this.ranks = this.$store.state.item.item.ranks;
      this.ages = this.$store.state.item.item.ages;
    },
    //PositionRank
    positionRank() {
      const PR = gamePR(this.createForm.game, this.positions, this.ranks);
      this.position = PR[0].slice();
      this.rank = PR[1].slice();
    },
    async create() {
      const response = await axios.post(
        "/api/recruit/team/pro",
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
        if (user.team.proama == "0") {
          if (user.leader == "0") {
            return next();
          } else if (user.leader == null) {
            return next("/myteam");
          }
        }
      } else if (!!user.child) {
        return next("/myteam");
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