<template>
  <div class="all" v-if="!!response">
    <h2 class="main-h2">選手登録情報</h2>

    <div class="add">
      <div class="error-pc" v-if="errors.name">
        <small class="small">※{{errors.name}}</small>
      </div>
      <div class="flex">
        <div class="error-mob" v-if="errors.name">
          <small class="small">※{{errors.name}}</small>
        </div>
        <div class="item-1">
          <div class="item-4">
            <span class="name">姓</span>
            <span class="name">名</span>
          </div>
        </div>
        <div class="item-2">
          <div class="item-3">
            <input type="text" class="select-3" v-model="editForm.first_name" />
            <input type="text" class="select-3" v-model="editForm.last_name" />
          </div>
        </div>
      </div>

      <div class="error-pc" v-if="errors.user_name">
        <small class="small">※{{errors.user_name[0]}}</small>
      </div>
      <div class="flex">
        <div class="item-1">
          <span class="name">ユーザー名</span>
          <div class="error-mob" v-if="errors.user_name">
            <small class="small">※{{errors.user_name[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <input type="text" class="select" v-model="editForm.user_name" />
        </div>
      </div>

      <div class="error-pc" v-if="errors.gender">
        <small class="small">※{{errors.gender[0]}}</small>
      </div>
      <div class="flex">
        <div class="item-1">
          <span class="name">性別</span>
          <div class="error-mob" v-if="errors.gender">
            <small class="small">※{{errors.gender[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <label class="radio1">
            男
            <input type="radio" name="gender" value="0" :checked="man" v-model="editForm.gender" />
          </label>
          <span>|</span>
          <label class="radio2">
            女
            <input type="radio" name="gender" value="1" :checked="woman" v-model="editForm.gender" />
          </label>
        </div>
      </div>

      <div class="error-pc" v-if="errors.twitter">
        <small class="small">※{{errors.twitter[0]}}</small>
      </div>
      <div class="flex">
        <div class="item-1">
          <span class="name">Twitter</span>
          <div class="error-mob" v-if="errors.twitter">
            <small class="small">※{{errors.twitter[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <input type="text" class="select" v-model="editForm.twitter" />
        </div>
      </div>

      <div class="error-pc" v-if="errors.birthday">
        <small class="small">※{{errors.birthday[0]}}</small>
      </div>
      <div class="flex">
        <div class="item-1">
          <span class="name">誕生日</span>
          <div class="error-mob" v-if="errors.birthday">
            <small class="small">※{{errors.birthday[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <div class="birthday">
            <select class="year birth" v-model="year">
              <option value>year</option>
              <option v-for="val in displayYear" :key="val" :value="val">{{val}}年</option>
            </select>
            <select class="month birth" v-model="month">
              <option value>month</option>
              <option v-for="n in 12" :key="n" :value="n">{{n}}月</option>
            </select>
            <select class="day birth" v-model="day">
              <option value>day</option>

              <option v-for="day in displayDay" :key="day" :value="day">{{day}}日</option>
            </select>
          </div>
        </div>
      </div>

      <div class="item-5">
        <router-link to="/profile" class="btn cancel">戻る</router-link>
        <input type="submit" value="変更" class="btn" @click.prevent="edit" />
      </div>
    </div>
  </div>
</template>

<script>
import { setTimeout } from "timers";
export default {
  name: "profileEdit",
  data() {
    return {
      editForm: {
        first_name: "",
        last_name: "",
        user_name: "",
        gender: "",
        twitter: "",
        birthday: ""
      },
      response: "",
      year: "",
      month: "",
      day: "",
      man: "",
      woman: "",
      errors: ""
      // editForm: {
      //   first_name: this.$store.state.auth.user.first_name,
      //   last_name: this.$store.state.auth.user.last_name,
      //   user_name: this.$store.state.auth.user.user_name,
      //   gender: this.$store.state.auth.user.gender,
      //   twitter: this.$store.state.auth.user.twitter,
      //   birthday: ""
      // },
      // year: this.$store.state.auth.user.birthday.split("-")[0],
      // month: parseInt(this.$store.state.auth.user.birthday.split("-")[1]),
      // day: parseInt(this.$store.state.auth.user.birthday.split("-")[2]),
      // ages: this.$store.state.item.ages,
      // man: this.$store.state.auth.user.gender == 0 ? true : false,
      // woman: this.$store.state.auth.user.gender == 1 ? true : false
    };
  },
  computed: {
    displayYear() {
      const today = new Date();
      const todayYear = today.getFullYear();

      const year = [];

      for (let i = todayYear - 30; i <= todayYear - 10; i++) {
        year.push(i);
      }
      return year;
    },
    displayDay() {
      //月の日数を取得する ex  getLastDay(2019,4)
      const getLastDay = (year, month) => {
        return new Date(year, month, 0).getDate();
      };
      const day = getLastDay(this.year, this.month);

      return day;
    }
  },
  methods: {
    async users() {
      const response = await axios.get("/api/user");
      this.response = response;

      this.editForm.first_name = response.data.first_name;
      this.editForm.last_name = response.data.last_name;
      this.editForm.user_name = response.data.user_name;
      this.editForm.gender = response.data.gender;
      this.editForm.twitter = response.data.twitter;
      this.editForm.birthday = response.data.birthday;
      const birthday = response.data.birthday;
      if (!!birthday) {
        this.year = Number(birthday.split("-")[0]);
        this.month = Number(birthday.split("-")[1]);
        this.day = Number(birthday.split("-")[2]);
      }
      this.man = response.data.gender == 0 ? true : false;
      this.woman = response.data.gender == 1 ? true : false;
    },
    async edit() {
      this.editForm.birthday =
        `${this.year}-${this.month}-${this.day}` == "--"
          ? null
          : `${this.year}-${this.month}-${this.day}`;

      // this.$store.dispatch("auth/profileEdit", this.editForm);
      const response = await axios.post("/api/profile/edit", this.editForm);

      if (response.status == 422) {
        const errors = response.data.errors;
        this.errors = errors;

        if (!!errors.first_name) {
          this.errors.name = errors.first_name[0];
        }
        if (!!errors.last_name) {
          this.errors.name = errors.last_name[0];
        }

        if (errors.first_name && errors.last_name) {
          this.errors.name = errors.first_name[0] + "※" + errors.last_name[0];
        }

        return;
      }

      if (response.status == 200) {
        this.$router.push("/profile");
      }
    }
  },
  watch: {
    $route: {
      async handler() {
        await this.users();
      },
      immediate: true
    }
  }
};
</script>

<style lang="sass" scoped>
@import '../../sass/profileEdit.scss'
</style>