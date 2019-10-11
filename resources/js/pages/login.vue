<template>
  <div class="all">
    <div class="add">
      <div class="error-pc" v-if="!!loginErrors.email">
        <small class="small">※{{loginErrors.email[0]}}</small>
      </div>
      <div class="flex">
        <div class="item-1">
          <span class="name">メールアドレス：</span>
          <div class="error-mob" v-if="!!loginErrors.email">
            <small class="small">※{{loginErrors.email[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <input type="text" name="email" class="select" v-model="loginForm.email" />
        </div>
      </div>

      <div class="error-pc" v-if="!!loginErrors.password">
        <small class="small">※{{loginErrors.password[0]}}</small>
      </div>
      <div class="flex">
        <div class="item-1">
          <span class="name">パスワード：</span>
          <div class="error-mob" v-if="!!loginErrors.password">
            <small class="small">※{{loginErrors.password[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <input type="password" name="password" class="select" v-model="loginForm.password" />
        </div>
      </div>

      <div class="item-5">
        <a class="forget" href>パスワード忘れた？</a>

        <input type="submit" value="ログイン" class="btn" @click.prevent="login" />
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";

export default {
  data() {
    return {
      loginForm: {
        email: "",
        password: ""
      }
    };
  },
  computed: {
    ...mapState({
      apiStatus: state => state.auth.apiStatus,
      loginErrors: state =>
        !!state.auth.loginErrorMessages ? state.auth.loginErrorMessages : ""
    })
  },
  methods: {
    async login() {
      await this.$store.dispatch("auth/login", this.loginForm);

      if (!this.apiStatus) {
        this.loginForm.password = "";
      }

      if (this.apiStatus) {
        // トップページに移動する
        this.$router.push("/");
      }
    },
    clearError() {
      this.$store.commit("auth/setLoginErrorMessages", null);
    }
  },
  created() {
    this.clearError();
  }
};
</script>

<style lang="sass" scoped>
@import '../../sass/auth.scss'
</style>