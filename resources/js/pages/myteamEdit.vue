<template>
  <div class="all">
    <h2 class="main-h2">マイチーム編集</h2>

    <div class="add">
      <div class="error-pc" v-if="errors.name">
        <small class="small">※{{errors.name[0]}}</small>
      </div>
      <div class="flex">
        <div class="item-1">
          <span class="name">チーム名</span>
          <div class="error-mob" v-if="errors.name">
            <small class="small">※{{errors.name[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <input type="text" class="select" v-model="editForm.name" />
        </div>
      </div>

      <div class="error-pc" v-if="team.proama == '0' && errors.pro_game">
        <small class="small">※{{errors.pro_game[0]}}</small>
      </div>
      <div class="flex" v-if="team.proama == '0'">
        <div class="item-1">
          <span class="name">ゲームタイトル</span>
          <div class="error-mob" v-if="team.proama == '0' && errors.pro_game">
            <small class="small">※{{errors.pro_game[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <div class="selectbox">
            <label class="selectbox" v-for="game in games" :key="game.id">
              {{game.name}}
              <input
                type="checkbox"
                name="pro_game[]"
                :value="game.id"
                v-model="editForm.pro_game"
              />
            </label>
            <span v-if="!games">全てのゲームに部門チームが作られています</span>
          </div>

          <!-- <div class="selectbox">
            <label class>
              <input type="checkbox" name="pro_game[]" value />
            </label>

            <label class>
              <input type="checkbox" name="pro_game[]" value />
            </label>
          </div>-->
        </div>
      </div>

      <div class="error-pc" v-if="team.proama == 1 && errors.ama_game">
        <small class="small">※{{errors.ama_game[0]}}</small>
      </div>
      <div class="flex" v-if="team.proama == 1">
        <div class="item-1">
          <span class="name">ゲームタイトル</span>
          <div class="error-mob" v-if="team.proama == 1 && errors.ama_game">
            <small class="small">※{{errors.ama_game[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <select class="select" v-model="editForm.ama_game">
            <option v-for="game in games" :key="game.id" :value="game.id">{{game.name}}</option>
          </select>
        </div>
      </div>

      <div class="error-pc" v-if="errors.email">
        <small class="small">※{{errors.email[0]}}</small>
      </div>
      <div class="flex">
        <div class="item-1">
          <span class="name">チームメールアドレス</span>
          <div class="error-mob" v-if="errors.email">
            <small class="small">※{{errors.email[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <input type="text" class="select" v-model="editForm.email" />
        </div>
      </div>

      <div class="error-pc" v-if="errors.hp">
        <small class="small">※{{errors.hp[0]}}</small>
      </div>
      <div class="flex">
        <div class="item-1">
          <span class="name">チームHP</span>
          <div class="error-mob" v-if="errors.hp">
            <small class="small">※{{errors.hp[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <input type="text" class="select" v-model="editForm.hp" />
        </div>
      </div>

      <div class="error-pc" v-if="errors.top">
        <small class="small">※{{errors.top[0]}}</small>
      </div>
      <div class="flex">
        <div class="item-1">
          <span class="name">代表者</span>
          <div class="error-mob" v-if="errors.top">
            <small class="small">※{{errors.top[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <input type="text" class="select" v-model="editForm.top" />
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
        <router-link to="/myteam" class="btn cancel">戻る</router-link>
        <input type="submit" value="変更" class="btn" @click.prevent="edit" />
      </div>
    </div>
  </div>
</template>

<script>
import { objectKey } from "../module/module";

export default {
  name: "myteam",
  data() {
    return {
      editForm: {
        name: "",
        email: "",
        hp: "",
        top: "",
        description: "",
        pro_game: "",
        ama_game: ""
      },
      user: "",
      team: "",
      errors: ""
      //   editForm: {
      //     name: this.$store.state.auth.user.team.name,
      //     email: this.$store.state.auth.user.team.email,
      //     hp: this.$store.state.auth.user.team.hp,
      //     top: this.$store.state.auth.user.team.top,
      //     description: this.$store.state.auth.user.team.description,
      //     pro_game: this.teamgame(this.$store.state.auth.user.team.teamgames),
      //     ama_game: this.$store.state.auth.user.team.teamgames[0].game.id
      //   },
      //   user: "",
      //   team: ""
    };
  },
  computed: {
    // user() {
    //   return this.$store.getters["auth/user"];
    // },
    // team() {
    //   return this.$store.getters["auth/user"].team;
    // },
    games() {
      const childId = objectKey(this.$store.state.auth.user.team.childs, "id");

      const games = [];
      this.$store.getters["item/games"].forEach(game => {
        if (childId.indexOf(game.id) == -1) {
          games.push(game);
        }
      });
      return games;
    }
  },
  methods: {
    teamgame(array, child) {
      // const childId = objectKey(this.$store.state.auth.user.team.childs, "id");

      const childId = objectKey(child, "id");

      let teamgame = [];

      array.forEach(x => {
        if (childId.indexOf(x.game.id) == -1) {
          teamgame.push(x.game.id);
        }
      });

      return teamgame;
    },
    async teams() {
      const response = await axios.get("/api/user");
      const team = response.data.team;

      // console.log(team);

      this.editForm.name = team.name;
      this.editForm.email = team.email;
      this.editForm.hp = team.hp;
      this.editForm.top = team.top;
      this.editForm.description = team.description;
      if (team.proama == 0) {
        this.editForm.pro_game = this.teamgame(
          team.teamgames,
          response.data.team.childs
        );
      }
      if (team.proama == 1) {
        this.editForm.ama_game = team.teamgames[0].game_id;
      }
      this.user = response.data;
      this.team = team;
    },
    async edit() {
      // this.$store.dispatch("auth/myTeamEdit", this.editForm);

      // console.log(this.editForm);

      const response = await axios.post("/api/myteam/edit", this.editForm);

      // console.log("response.data");
      // console.log(response);

      if (response.status == 422) {
        this.errors = response.data.errors;
        return;
      }

      if (response.status == 200) {
        this.$router.push("/myteam");
      }
    }
  },
  watch: {
    $route: {
      async handler() {
        await this.teams();
      },
      immediate: true
    }
  },
  beforeRouteEnter(route, redirect, next) {
    async function middleware() {
      const response = await axios.get("/api/user");

      const user = response.data;

      // console.log(response.data);

      return !!user.team && user.leader == "0" ? next() : false;
    }

    middleware();
  }
};
</script>

<style lang="sass" scoped>
@import '../../sass/myteamEdit.scss'
</style>