<template>
  <div class="all" v-if="!!game_name">
    <h2 class="main-h2">マイチーム部門編集</h2>

    <div class="add">
      <div class="flex">
        <div class="item-1">
          <span class="name">ゲーム名</span>
        </div>
        <div class="item-2">
          <span class="text">{{ game_name }}</span>
        </div>
        <div class="item-5" @click="breakUp">
          <span class="btn">解散する</span>
        </div>
      </div>

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
          <input type="text" class="select tx-name" v-model="editForm.name" />
        </div>
      </div>

      <div class="leader">
        <div class="item-1">
          <span class="name">リーダー</span>
        </div>

        <div class="item-2">
          <span class="select">
            {{leader.user_name}}
            <i class="fas fa-crown"></i>
          </span>
          <div class="pass">
            <span class="btn btn1" @click="check=true">リーダー交代</span>
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
          <select class="select" v-model="leaderForm.leader">
            <option class="option" value>選択しない</option>

            <option
              v-for="member in members"
              :key="member.id"
              :value="member.id"
            >{{member.user_name}}</option>
          </select>

          <div class="item-5">
            <input type="submit" name="btn_leader" value="交代" class="btn" @click="lead" />
          </div>
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

        <div class="member-btn-box" @click="plus=true">
          <!-- <span class="btn member-btn">メンバー追加</span> -->
          <span class="btn">メンバー追加</span>
        </div>
      </div>

      <div class="error-pc" v-if="errors.add_member">
        <small class="small">※{{errors.add_member[0]}}</small>
      </div>

      <div class="error-mob" v-if="errors.add_member">
        <small class="small">※{{errors.add_member[0]}}</small>
      </div>
      <div class="plus" v-show="plus">
        <div class="item-1"></div>

        <div class="item-2">
          <input type="text" class="select" v-model="addForm.add_member" />
        </div>
        <div class="item-5">
          <input type="submit" value="追加" class="btn" @click="add" />
        </div>
      </div>

      <div class="error-pc" v-if="errors.email">
        <small class="small">※{{errors.email[0]}}</small>
      </div>
      <div class="flex">
        <div class="item-1">
          <span class="name">メールアドレス</span>
          <div class="error-mob" v-if="errors.email">
            <small class="small">※{{errors.email[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <input type="text" class="select tx-mail" v-model="editForm.email" />
        </div>
      </div>

      <div class="error-pc" v-if="errors.top">
        <small class="small">※{{errors.top[0]}}</small>
      </div>
      <div class="flex">
        <div class="item-1">
          <span class="name">チーム代表者名</span>
          <div class="error-mob" v-if="errors.top">
            <small class="small">※{{errors.top[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <input type="text" class="select tx-top" v-model="editForm.top" />
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
          <textarea cols="35" rows="10" class="body tx-des" v-model="editForm.description"></textarea>
        </div>
      </div>

      <div class="item-5">
        <router-link to="/myteam" class="btn cancel">戻る</router-link>
        <span class="btn child-btn" @click.prevent="edit">変更</span>
      </div>
    </div>
  </div>
</template>

<script>
import { objectKey } from "../module/module";

export default {
  name: "myteam",
  props: {
    id: Number
  },
  data() {
    return {
      editForm: {
        name: "",
        email: "",
        top: "",
        description: ""
      },
      leaderForm: {
        leader: ""
      },
      addForm: {
        add_member: ""
      },
      leaveForm: {
        leave: ""
      },
      game_name: "",
      members: "",
      leader: "",
      check: false,
      plus: false,
      errors: ""
    };
  },
  methods: {
    async childs() {
      const response = await axios.get(`/api/myteam/child/${this.id}`);

      const child = response.data.child;

      this.members = response.data.users.filter(x => {
        return x.leader == null;
      });

      const leader = response.data.users.filter(x => {
        return x.leader == 0;
      });

      this.leader = leader[0];

      this.editForm.name = child.name;
      this.editForm.email = child.email;
      this.editForm.top = child.top;
      this.editForm.description = child.description;

      this.game_name = child.teamgame.game.name;
    },
    //解散
    async breakUp() {
      const data = { child: this.id };

      const response = await axios.post(
        `/api/myteam/child/breakup/${this.id}`,
        data
      );
      this.$router.push("/myteam");
    },
    //編集
    async edit() {
      // console.log(this.editForm);

      const response = await axios.post(
        `/api/myteam/child/edit/${this.id}`,
        this.editForm
      );

      if (response.status == 422) {
        this.errors = response.data.errors;
        return;
      }

      if (response.status == 200) {
        this.$router.push("/myteam");
      }
    },
    //リーダー変更
    async lead() {
      const response = await axios.post(
        `/api/myteam/child/leader/${this.id}`,
        this.leaderForm
      );

      // console.log(response.data);

      if (response.status == 422) {
        this.errors = response.data.errors;
        return;
      }

      if (response.status == 200) {
        this.leader = response.data.leader;
        this.members = this.members.filter(x => {
          return x.id != this.leader.id;
        });
        this.members.push(response.data.user);

        this.leaderForm.leader = "";
        this.errors = "";
      }
    },
    //メンバー追加
    async add() {
      const response = await axios.post(
        `/api/myteam/child/add/${this.id}`,
        this.addForm
      );

      if (response.status == 422) {
        this.errors = response.data.errors;
        return;
      }

      if (response.status == 200) {
        this.members.push(response.data);
      }
    },
    async leave(e) {
      // console.log(e.currentTarget.getAttribute("data-id"));
      //脱退させるuserのid
      const leaveId = e.currentTarget.getAttribute("data-id");

      this.leaveForm.leave = leaveId;

      // console.log(this.editForm.leave)

      const response = await axios.post(
        `/api/myteam/child/leave/${this.id}`,
        this.leaveForm
      );

      if (response.status == 422) {
        this.errors = response.data.errors;
        return;
      }

      if (response.status == 200) {
        this.members = this.members.filter(x => x.id != response.data.id);
      }
    }
  },
  watch: {
    $route: {
      async handler() {
        await this.childs();
      },
      immediate: true
    }
  },
  beforeRouteEnter(route, redirect, next) {
    const that = this;

    async function middleware() {
      const response = await axios.get("/api/user");

      const user = response.data;

      console.log(response.data);

      return !!user.team && user.leader == "0" ? next() : false;

      if (
        (user.leader == 0 && user.child_id == that.id) ||
        (user.leader == 0 && user.team_id != null)
      ) {
        return next();
      }
      return;
    }

    middleware();
  }
};
</script>

<style lang="sass" scoped>
@import '../../sass/myteamEdit.scss'
</style>