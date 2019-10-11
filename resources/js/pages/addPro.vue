<template>
  <div class="all" v-if="!!response">
    <h2 class="main-h2"></h2>

    <div class="add">
      <h3 class="title">部門チーム登録</h3>

      <div class="error-pc" v-if="errors.name">
        <small class="small">※{{errors.name[0]}}</small>
      </div>
      <div class="flex">
        <div class="item-1">
          <span class="name">チーム名：</span>
          <div class="error-mob" v-if="errors.name">
            <small class="small">※{{errors.name[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <input type="text" name="name" class="select" v-model="createForm.name" />
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
          <select name="game" class="game select" v-model="createForm.game">
            <option value>未選択</option>
            <option :value="game.id" v-for="game in games" :key="game.id">{{ game.name }}</option>
          </select>
        </div>
      </div>

      <div class="error-pc" v-if="errors.top">
        <small class="small">※{{errors.top[0]}}</small>
      </div>
      <div class="flex pro-top">
        <div class="item-1">
          <span class="name">代表名：</span>
          <div class="error-mob" v-if="errors.top">
            <small class="small">※{{errors.top[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <input type="text" name="top" class="select" v-model="createForm.top" />
        </div>
      </div>

      <div class="error-pc" v-if="errors.email">
        <small class="small">※{{errors.email[0]}}</small>
      </div>
      <div class="flex">
        <div class="item-1">
          <span class="name">連絡先：</span>
          <div class="error-mob" v-if="errors.email">
            <small class="small">※{{errors.email[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <input
            type="text"
            name="email"
            class="select"
            placeholder="example@〇〇〇.〇〇"
            v-model="createForm.email"
          />
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
  name: "addPro",
  data() {
    return {
      createForm: {
        name: "",
        top: "",
        email: "",
        description: "",
        game: ""
      },
      games: [],
      errors: "",
      response: ""
    };
  },
  methods: {
    async options() {
      const response = await axios.get("/api/add/pro");

      this.response = response;
      // console.log(response.data);
      this.games = response.data.games;
    },
    async create() {
      const response = await axios.post("/api/add/pro", this.createForm);

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
        if (user.leader == "0") {
          return next();
        } else if (user.leader == null) {
          return next("/myteam");
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
@import '../../sass/add.scss'
</style>