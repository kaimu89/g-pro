<template>
  <div class="all" v-if="!!editForm.email">
    <h2 class="main-h2">メールアドレス変更</h2>

    <div class="add">
      <div class="error-pc" v-if="errors.email">
        <small class="small">※{{errors.email[0]}}</small>
      </div>
      <div class="flex">
        <div class="item-1">
          <span class="name">メールアドレス：</span>
          <div class="error-mob" v-if="errors.email">
            <small class="small">※{{errors.email[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <input type="text" name="email" class="select" v-model="editForm.email" />
        </div>
      </div>

      <div class="item-5">
        <router-link to="/profile" class="btn cancel">戻る</router-link>
        <input type="submit" value="送信" class="btn" @click.prevent="edit" />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "profileEdit",
  data() {
    return {
      editForm: {
        email: ""
      },
      errors: ""
    };
  },
  // computed: {
  //   user() {
  //     return this.$store.getters["auth/user"];
  //   }
  // },
  methods: {
    async users() {
      const response = await axios.get("/api/user");

      this.editForm.email = response.data.email;
    },
    async edit() {
      // this.$store.dispatch("auth/profileEmail", this.editForm);

      const response = await axios.post("/api/profile/email", this.editForm);

      // console.log(response);

      if (response.status == 422) {
        this.errors = response.data.errors;
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