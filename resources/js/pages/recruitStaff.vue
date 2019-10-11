<template>
  <div class="all" v-if="!!team">
    <h2 class="main-h2"></h2>

    <div class="add">
      <h3 class="title">スタッフ</h3>
      <form action method="post">
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
            <span class="name">チームタイトル：</span>
            <div class="error-mob" v-if="errors.game">
              <small class="small">※{{errors.game[0]}}</small>
            </div>
          </div>
          <div class="item-2">
            <select
              name="game"
              class="game select"
              v-model="createForm.game"
              v-if="team.proama=='0'"
            >
              <option value>選択して下さい</option>
              <option v-for="game in games" :key="game.id" :value="game.id">{{game.name}}</option>
            </select>
            <span class="text" v-if="team.proama==1">{{games[0].name}}</span>
          </div>
        </div>

        <div class="error-pc" v-if="errors.staff">
          <small class="small">※{{errors.staff[0]}}</small>
        </div>
        <div class="flex">
          <div class="item-1">
            <span class="name">職種：</span>
            <div class="error-mob" v-if="errors.staff">
              <small class="small">※{{errors.staff[0]}}</small>
            </div>
          </div>
          <div class="item-2">
            <select name="staff" class="select" v-model="createForm.staff">
              <option value>選択して下さい</option>
              <option :value="staff.id" v-for="staff in staffs" :key="staff.id">{{ staff.name }}</option>
            </select>
          </div>
        </div>

        <div class="error-pc" v-if="errors.content">
          <small class="small">※{{errors.content[0]}}</small>
        </div>
        <div class="flex">
          <div class="item-1">
            <span class="name">仕事内容：</span>
            <div class="error-mob" v-if="errors.content">
              <small class="small">※{{errors.content[0]}}</small>
            </div>
          </div>
          <div class="item-2">
            <input type="text" name="content" class="select" v-model="createForm.content" />
          </div>
        </div>

        <div class="error-pc" v-if="errors.ab_skill">
          <small class="small">※{{errors.ab_skill[0]}}</small>
        </div>
        <div class="flex">
          <div class="item-1">
            <span class="name">必須スキル：</span>
            <div class="error-mob" v-if="errors.ab_skill">
              <small class="small">※{{errors.ab_skill[0]}}</small>
            </div>
          </div>
          <div class="item-2">
            <input type="text" name="ab_skill" class="select" v-model="createForm.ab_skill" />
          </div>
        </div>

        <div class="error-pc" v-if="errors.wel_skill">
          <small class="small">※{{errors.wel_skill[0]}}</small>
        </div>
        <div class="flex">
          <div class="item-1">
            <span class="name">歓迎スキル：</span>
            <div class="error-mob" v-if="errors.wel_skill">
              <small class="small">※{{errors.wel_skill[0]}}</small>
            </div>
          </div>
          <div class="item-2">
            <input type="text" name="wel_skill" class="select" v-model="createForm.wel_skill" />
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
      </form>
    </div>
  </div>
</template>

<script>
export default {
  name: "recruitStaff",
  data() {
    return {
      createForm: {
        game: "",
        staff: "",
        content: "",
        ab_skill: "",
        wel_skill: "",
        description: ""
      },
      staffs: this.$store.state.item.item.staffs,
      games: "",
      team: "",
      errors: ""
    };
  },
  methods: {
    async options() {
      const response = await axios.get("/api/recruit/staff");
      this.team = response.data.user.team;
      this.games = response.data.games;
    },
    async create() {
      const response = await axios.post("/api/recruit/staff", this.createForm);

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

      if (!!user.team && user.leader == "0") {
        return next();
      } else if (!!user.team && user.leader == null) {
        return next("/myteam");
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