<template>
  <div class="all">
    <div class="add">
      <div class="error-pc" v-if="!!registerErrors.user_name">
        <small class="small">※{{registerErrors.user_name[0]}}</small>
      </div>
      <div class="flex">
        <div class="item-1">
          <span class="name">ユーザー名：</span>
          <div class="error-mob" v-if="!!registerErrors.user_name">
            <small class="small">※{{registerErrors.user_name[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <input type="text" class="select" v-model="registerForm.user_name" />
        </div>
      </div>

      <div class="error-pc" v-if="!!registerErrors.email">
        <small class="small">※{{registerErrors.email[0]}}</small>
      </div>
      <div class="flex">
        <div class="item-1">
          <span class="name">メールアドレス：</span>
          <div class="error-mob" v-if="!!registerErrors.email">
            <small class="small">※{{registerErrors.email[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <input type="text" class="select" v-model="registerForm.email" />
        </div>
      </div>

      <div class="error-pc" v-if="!!registerErrors.password">
        <small class="small">※{{registerErrors.password[0]}}</small>
      </div>
      <div class="flex">
        <div class="item-1">
          <span class="name">パスワード：</span>
          <div class="error-mob" v-if="!!registerErrors.password">
            <small class="small">※{{registerErrors.password[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <input type="password" class="select" v-model="registerForm.password" />
        </div>
      </div>

      <div class="flex">
        <div class="item-1">
          <span class="name">確認用パスワード：</span>
        </div>
        <div class="item-2">
          <input
            type="password"
            name="password_confirmation"
            class="select"
            v-model="registerForm.password_confirmation"
          />
        </div>
      </div>

      <div class="item-5">
        <input type="submit" value="登録" class="btn" @click.prevent="register" />
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";

export default {
  data() {
    return {
      registerForm: {
        user_name: "",
        email: "",
        password: "",
        password_confirmation: ""
      }
    };
  },
  computed: {
    ...mapState({
      apiStatus: state => state.auth.apiStatus,
      registerErrors: state =>
        !!state.auth.registerErrorMessages
          ? state.auth.registerErrorMessages
          : ""
    })
  },
  methods: {
    async register() {
      await this.$store.dispatch("auth/register", this.registerForm);

      if (!this.apiStatus) {
        this.registerForm.password = "";
        this.registerForm.password_confirmation = "";
      }

      if (this.apiStatus) {
        // トップページに移動する
        this.$router.push("/");
      }
    },
    clearError() {
      this.$store.commit("auth/setRegisterErrorMessages", null);
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