<template>
  <div class="all" v-if="!!team">
    <h2 class="main-h2">マイチーム</h2>

    <div class="add">
      <div class="title">
        <div class="item-2">
          <span class="name">{{team.name}}</span>
        </div>
        <div class="item-5">
          <span class="btn" @click="leave">脱退する</span>
        </div>
      </div>

      <div class="photo">
        <div class="picture-myteam">
          <img src alt class="user-p p" />
        </div>

        <div class="picture">
          <img src="0Qp7HbEmWbCY2yZ7xVSgsqpCZp20s5Spi03YNDtt.jpeg" alt class="nanashi-p p" />
        </div>

        <div class="input">
          <form action method="post">
            <input type="file" name="logo" class="file" accept="image/*" />
            <div class="item-5">
              <input type="submit" value="変更する" class="btn" />
            </div>
          </form>
        </div>
      </div>

      <div class="in-btn">
        <div class="flex2">
          <div class="item-1">
            <span class="name">メンバー名</span>
          </div>
          <div class="item-2">
            <div class="item-3" v-for="member in team.users" :key="`member-${member.id}`">
              <span class="select">
                {{member.user_name}}
                <i class="fas fa-crown" v-show="member.leader == 0"></i>
              </span>
            </div>
          </div>
        </div>

        <div class="item-5">
          <router-link
            to="/myteam/member"
            class="btn"
            v-if="user.leader == 0 && user.team_id != null"
          >変更する</router-link>
        </div>
      </div>

      <div class="flex" v-if="team.proama == 1">
        <div class="item-1">
          <span class="name">ゲームタイトル</span>
        </div>
        <div class="item-2">
          <span class="select">{{team.teamgames[0].game.name}}</span>
        </div>
      </div>

      <div class="flex">
        <div class="item-1">
          <span class="name">チームHP</span>
        </div>

        <div class="item-2">
          <span class="select">{{team.hp}}</span>

          <span class="select" v-if="team.hp == null">設定されてません</span>
        </div>
      </div>

      <div class="flex">
        <div class="item-1">
          <span class="name">チーム代表者</span>
        </div>
        <div class="item-2">
          <span class="select">{{team.top}}</span>

          <span class="select" v-if="!team.top">設定されてません</span>
        </div>
      </div>

      <div class="flex">
        <div class="item-1">
          <span class="name">チームメールアドレス</span>
        </div>

        <div class="item-2">
          <span class="select">{{team.mail}}</span>

          <span class="select" v-if="!team.mail">設定されてません</span>
        </div>
      </div>

      <div class="flex">
        <div class="item-1">
          <span class="name">紹介文</span>
        </div>
        <div class="item-2">
          <span class="select">{{team.description}}</span>

          <span class="select" v-if="!team.description">設定されてません</span>
        </div>
      </div>

      <div class="item-5 out">
        <router-link
          to="/myteam/edit"
          class="btn"
          v-if="user.leader == 0 && user.team_id != null"
        >変更する</router-link>
      </div>

      <div class="child">
        <div class="flex" v-for="child in team.childs" :key="child.id + '-child'">
          <div class="flex2">
            <div class="item-1">
              <span class="name">{{child.name}}</span>
            </div>
            <div class="item-2">
              <span class="select">~{{child.teamgame.game.name}}部門~</span>
            </div>
          </div>

          <div class="flex3">
            <div class="item-1">
              <span class="name">メンバー</span>
            </div>
            <div class="item-2">
              <div class="item-3" v-for="member in child.users" :key="member.id">
                <span class="name">
                  {{member.user_name}}
                  <i class="fas fa-crown" v-if="member.leader == 0"></i>
                </span>
              </div>
            </div>
          </div>

          <div class="item-5">
            <router-link
              :to="`/myteam/child/${child.id}`"
              class="btn"
              v-if="(user.leader == 0 && child.id == user.child_id) || (user.leader == 0 && user.team_id != null)"
            >変更する</router-link>
          </div>
        </div>
      </div>

      <div id="recruit">
        <div class="team-rec">
          <span class="bosyu">マイチーム募集</span>
        </div>

        <div class="recbox">
          <span class="no-rec" v-if="recruits == ''">募集をしてません。</span>
        </div>

        <div class="flex2" v-for="recruit in recruits" :key="recruit.id">
          <div class="item-1">
            <span class="name" v-if="!recruit.staff_id">募集：選手</span>
            <span class="name" v-else>募集：{{recruit.staff.name}}</span>
            <span class="name">タイトル名：{{recruit.game.name}}</span>
          </div>

          <div class="item-2" v-if="!recruit.staff_id">
            <span class="name">ポジション：{{recruit.position.name}}</span>

            <span class="name" v-if="recruit.rank_status == 0">ランク：{{recruit.rank.name}}以上</span>

            <span class="name" v-if="recruit.rank_status == null">ランク：{{recruit.rank.name}}</span>
          </div>
          <div class="item-2" v-else>
            <span class="name">仕事内容：{{recruit.content}}</span>
          </div>

          <div class="item-3" v-if="!recruit.staff_id">
            <span class="name">年齢：{{recruit.age}}</span>
            <span class="name">ｹﾞｰﾐﾝｸﾞﾊｳｽ：{{recruit.house}}</span>
          </div>
          <div class="item-3" v-else>
            <span class="name">必須スキル：{{recruit.ab_skill}}</span>
            <span class="name">歓迎スキル：{{recruit.well_skill}}</span>
          </div>
          <div class="item-4">
            <span class="name">説明文：{{recruit.description}}</span>
          </div>

          <div class="item-5">
            <span
              class="btn"
              v-if="user.leader == 0 && user.team_id != null"
              :data-id="recruit.id"
              @click="del"
            >消去する</span>

            <router-link
              :to="`/myteam/recruit/${recruit.id}`"
              class="btn"
              v-if="user.leader == 0 && user.team_id != null"
            >変更する</router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "myteam",
  data() {
    return {
      deleteForm: {
        delete: ""
      },
      leaveForm: {
        leave: ""
      },
      user: "",
      team: "",
      recruits: ""
    };
  },
  // computed: {
  //   user() {
  //     return this.$store.getters["auth/user"];
  //   },
  //   team() {
  //     return this.$store.getters["auth/user"].team;
  //   }
  // }
  methods: {
    async teams() {
      const response = await axios.get("api/myteam");

      this.user = response.data.user;
      this.team = response.data.team;
      this.recruits = response.data.recruits;

      // console.log(response.data);
    },
    async del(e) {
      const deleteId = e.currentTarget.getAttribute("data-id");

      // console.log(deleteId);

      this.deleteForm.delete = deleteId;

      const response = await axios.post("/api/myteam", this.deleteForm);

      // console.log(response.data);

      this.recruits = this.recruits.filter(x => x.id != response.data);
    },
    async leave() {
      this.leaveForm.leave = true;

      const response = await axios.post("/api/myteam", this.leaveForm);

      this.$router.push("/");
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

      return !!user.team || !!user.child ? next() : false;
    }

    middleware();
  }
};
</script>

<style lang="sass" scoped>
@import '../../sass/myteamShow.scss'
</style>