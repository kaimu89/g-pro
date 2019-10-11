<template>
  <div class="all" v-if="!!response">
    <h2 class="main-h2">メンバー変更</h2>
    <div class="add">
      <div class="leader">
        <div class="item-1">
          <span class="name">リーダー</span>
        </div>

        <div class="item-2">
          <span class="select">
            {{leader.user_name}}
            <i class="fas fa-crown"></i>
          </span>
          <div class="pass" @click="check=true">
            <span class="btn btn1">リーダー交代</span>
          </div>
        </div>
      </div>

      <div class="error-pc" v-if="errors.leader">
        <small class="small">※{{errors.leader[0]}}</small>
      </div>
      <div class="error-mob" v-if="errors.leader">
        <small class="small">※{{errors.leader[0]}}</small>
      </div>
      <div class="check" v-show="check">
        <div class="item-2">
          <select name="leader" class="select" v-model="editForm.leader">
            <option class="option" value>選択しない</option>
            <option
              v-for="member in members"
              :key="member.id"
              :value="member.id"
            >{{member.user_name}}</option>
          </select>
        </div>
        <div class="item-5">
          <input type="submit" name="btn_leader" value="交代" class="btn" @click="change" />
        </div>
      </div>

      <div class="member">
        <div class="item-1">
          <span class="name">メンバー</span>
        </div>
        <div class="error-pc" v-if="errors.leave">
          <small class="small">※{{errors.leave[0]}}</small>
        </div>
        <div class="error-mob" v-if="errors.leave">
          <small class="small">※{{errors.leave[0]}}</small>
        </div>
        <div class="item-2" v-for="member in members" :key="member.id">
          <span class="select">{{member.user_name}}</span>
          <div class="delete">
            <span class="btn btn2" :data-id="member.id" @click="leave">脱退させる</span>
          </div>
        </div>
        <div class="member-btn-box">
          <span class="member-btn">メンバー招待</span>
        </div>
      </div>

      <div class="error-pc" v-if="errors.add_member">
        <small class="small">※{{errors.add_member[0]}}</small>
      </div>
      <div class="error-mob" v-if="errors.add_member">
        <small class="small">※{{errors.add_member[0]}}</small>
      </div>
      <div class="plus">
        <div class="item-1"></div>
        <form action method="post">
          <div class="item-2">
            <input type="text" class="select" name="add_member" v-model="editForm.add_member" />
          </div>
          <div class="item-5">
            <input type="submit" name="btn_member" class="btn" @click.prevent="add" />
          </div>
        </form>
      </div>

      <div class="item-5">
        <router-link to="/myteam" class="btn cancel">戻る</router-link>
        <router-link to="/myteam" class="btn">完了</router-link>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      editForm: {
        leader: "",
        leave: "",
        add_member: ""
      },
      members: "",
      leader: "",
      check: false,
      errors: "",
      response: ""
    };
  },
  computed: {
    // //membersにはリーダーはいない
    // members() {
    //   console.log(this.$store.getters["auth/user"].team.users);
    //   const members = this.$store.getters["auth/user"].team.users.filter(x => {
    //     return x.leader == null;
    //   });
    //   return members;
    // },
    // //リーダーを取り出す。
    // leader() {
    //   const leader = this.$store.getters["auth/user"].team.users.filter(x => {
    //     return x.leader == 0;
    //   });
    //   console.log(leader);
    //   return leader[0];
    // }
  },
  methods: {
    async team() {
      const response = await axios.get("/api/user");

      this.response = response;

      this.members = response.data.team.users.filter(x => {
        return x.leader == null;
      });
      const leader = response.data.team.users.filter(x => {
        return x.leader == 0;
      });
      this.leader = leader[0];
    },
    async change() {
      // this.$store.dispatch("auth/leader", this.editForm);

      const response = await axios.post(
        "/api/myteam/member/leader",
        this.editForm
      );

      if (response.status == 422) {
        this.errors = response.data.errors;
        return;
      }

      // console.log(response);

      if (response.status == 200) {
        this.$router.push("/myteam");
      }
    },
    async leave(e) {
      // console.log(e.currentTarget.getAttribute("data-id"));
      //脱退させるuserのid
      const leaveId = e.currentTarget.getAttribute("data-id");

      this.editForm.leave = leaveId;

      // console.log(this.editForm.leave)

      const response = await axios.post(
        "/api/myteam/member/edit",
        this.editForm
      );

      if (response.status == 422) {
        this.errors = response.data.errors;
        return;
      }

      if (response.status == 200) {
        this.members = this.members.filter(x => x.id != response.data.id);
      }
    },
    async add() {
      const response = await axios.post(
        "/api/myteam/member/add",
        this.editForm
      );

      // console.log(response);

      if (response.status == 422) {
        this.errors = response.data.errors;
        return;
      }

      if (response.status == 200) {
        this.members.push(response.data);

        this.editForm.add_member = "";
      }
    }
  },
  watch: {
    $route: {
      async handler() {
        await this.team();
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

