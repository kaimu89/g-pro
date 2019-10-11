<template>
  <div class="all">
    <h2 class="main-h2">選手登録情報</h2>

    <div class="add">
      <div class="error-pc" v-if="errors.ign">
        <small class="small">※{{errors.ign[0]}}</small>
      </div>
      <div class="flex">
        <div class="item-1">
          <span class="name">IGN</span>
          <div class="error-mob" v-if="errors.ign">
            <small class="small">※{{errors.ign[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <input type="text" class="select" v-model="editForm.ign" />
        </div>
      </div>

      <div class="error-pc" v-if="errors.proama">
        <small class="small">※{{errors.proama[0]}}</small>
      </div>
      <div class="flex">
        <div class="item-1">
          <span class="name">志望チーム</span>
          <div class="error-mob" v-if="errors.proama">
            <small class="small">※{{errors.proama[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <label class="radio1">
            プロ
            <input type="radio" value="0" :checked="pro" v-model="editForm.proama" />
          </label>
          <span>|</span>
          <label class="radio2">
            一般
            <input type="radio" value="1" :checked="ama" v-model="editForm.proama" />
          </label>
        </div>
      </div>

      <div class="error-pc" v-if="errors.game_id">
        <small class="small">※{{errors.game_id[0]}}</small>
      </div>
      <div class="flex">
        <div class="item-1">
          <span class="name">ゲームタイトル</span>
          <div class="error-mob" v-if="errors.game_id">
            <small class="small">※{{errors.game_id[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <select class="select" v-model="editForm.game_id" @change="positionRank">
            <option value>選択して下さい</option>
            <option v-for="game in games" :key="game.id + '-game'" :value="game.id">{{game.name}}</option>
          </select>
        </div>
      </div>

      <div class="error-pc" v-if="errors.position_id">
        <small class="small">※{{errors.position_id[0]}}</small>
      </div>
      <div class="flex">
        <div class="item-1">
          <span class="name">ポジション</span>
          <div class="error-mob" v-if="errors.position_id">
            <small class="small">※{{errors.position_id[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <select class="select" v-model="editForm.position_id">
            <option value>選択して下さい</option>
            <option
              v-for="position in position"
              :key="position.id + '-position'"
              :value="position.id"
            >{{position.name}}</option>
          </select>
        </div>
      </div>

      <div class="error-pc" v-if="errors.rank_id">
        <small class="small">※{{errors.rank_id[0]}}</small>
      </div>
      <div class="flex">
        <div class="item-1">
          <span class="name">ランク</span>
          <div class="error-mob" v-if="errors.rank_id">
            <small class="small">※{{errors.rank_id[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <select class="select" v-model="editForm.rank_id">
            <option value>選択して下さい</option>
            <option v-for="rank in rank" :key="rank.id + '-rank'" :value="rank.id">{{rank.name}}</option>
          </select>
        </div>
      </div>

      <div class="error-pc" v-if="errors.description">
        <small class="small">※{{errors.description[0]}}</small>
      </div>
      <div class="flex">
        <div class="item-1">
          <span class="name">紹介文</span>
          <div class="error-mob" v-if="errors.description">
            <small class="small">※{{errors.description[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <textarea cols="35" rows="10" class="body" v-model="editForm.description"></textarea>
        </div>
      </div>

      <div class="item-5">
        <router-link to="/myplayer" class="btn cancel">戻る</router-link>
        <input type="submit" value="変更" class="btn" @click.prevent="edit" />
      </div>
    </div>
  </div>
</template>

<script>
import { objectKey } from "../module/module";
import { gamePR } from "../module/module";

export default {
  name: "profileEdit",
  data() {
    return {
      editForm: {
        ign: "",
        proama: "",
        game_id: "",
        position_id: "",
        rank_id: "",
        description: ""
      },
      games: this.$store.state.item.item.games,
      positions: this.$store.state.item.item.positions,
      position: "",
      ranks: this.$store.state.item.item.ranks,
      rank: "",
      pro: "",
      ama: "",
      errors: ""
      // editForm: {
      //   ign: this.$store.state.auth.user.player.ign,
      //   proama: this.$store.state.auth.user.player.proama,
      //   game_id: this.$store.state.auth.user.player.game_id,
      //   position_id: this.$store.state.auth.user.player.position_id,
      //   rank_id: this.$store.state.auth.user.player.rank_id,
      //   description: this.$store.state.auth.user.player.description
      // },
      // games: this.$store.state.item.item.games,
      // positions: this.$store.state.item.item.positions,
      // ranks: this.$store.state.item.item.ranks,
      // pro: this.$store.state.auth.user.player.proama == 0 ? true : false,
      // ama: this.$store.state.auth.user.player.proama == 1 ? true : false
    };
  },
  methods: {
    async players() {
      const response = await axios.get("/api/user");

      this.editForm.ign = response.data.player.ign;
      this.editForm.proama = response.data.player.proama;
      this.editForm.game_id = response.data.player.game_id;
      this.editForm.position_id = response.data.player.position_id;
      this.editForm.rank_id = response.data.player.rank_id;
      this.editForm.description = response.data.player.description;

      const PR = gamePR(this.editForm.game_id, this.positions, this.ranks);
      this.position = PR[0].slice();
      this.rank = PR[1].slice();
    },
    positionRank() {
      const PR = gamePR(this.editForm.game_id, this.positions, this.ranks);

      // console.log(PR);
      this.position = PR[0].slice();
      this.editForm.position_id = "";
      this.rank = PR[1].slice();
      this.editForm.rank_id = "";
    },
    async edit() {
      // this.$store.dispatch("auth/myPlayerEdit", this.editForm);

      const response = await axios.post("/api/myplayer/edit", this.editForm);

      if (response.status == 422) {
        this.errors = response.data.errors;
        return;
      }

      if (response.status == 200) {
        this.$router.push("/myplayer");
      }
    }
  },
  watch: {
    $route: {
      async handler() {
        await this.players();
      },
      immediate: true
    }
    //dataをwatchするときにこのように書くとデータの変更に対応して処理を行える。
    // "editForm.game_id": {
    //   handler(newVal, oldVal) {
    //     this.editForm.position_id = 0;
    //     console.log("watch");
    //   },
    //   deep: true
    // }
  },
  beforeRouteEnter(route, redirect, next) {
    async function middleware() {
      const response = await axios.get("/api/user");

      const user = response.data;

      console.log(response.data);

      return !!user.player ? next() : false;
    }

    middleware();
  }
};
</script>

<style lang="sass" scoped>
@import '../../sass/myplayerEdit.scss'
</style>