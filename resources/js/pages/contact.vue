<template>
  <div class="all">
    <h2 class="main-h2">お問い合わせ</h2>

    <div class="add">
      <div class="error-pc" v-if="errors.name">
        <small class="small">※{{errors.name[0]}}</small>
      </div>
      <div class="flex">
        <div class="item-1">
          <span class="name">名前：</span>
          <div class="error-mob" v-if="errors.name">
            <small class="small">※{{errors.name[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <input type="text" name="name" class="select" v-model="submitForm.name" />
        </div>
      </div>

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
          <input type="text" name="email" class="select" v-model="submitForm.email" />
        </div>
      </div>

      <div class="error-pc" v-if="errors.title">
        <small class="small">※{{errors.title[0]}}</small>
      </div>
      <div class="flex">
        <div class="item-1">
          <span class="name">お問い合わせ名：</span>
          <div class="error-mob" v-if="errors.title">
            <small class="small">※{{errors.title[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <input type="text" name="title" class="select" v-model="submitForm.title" />
        </div>
      </div>

      <div class="error-pc" v-if="errors.body">
        <small class="small">※{{errors.body[0]}}</small>
      </div>
      <div class="flex">
        <div class="item-1">
          <span class="name">お問い合わせ内容：</span>
          <div class="error-mob" v-if="errors.body">
            <small class="small">※{{errors.body[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <textarea name="body" cols="35" rows="10" class="body" v-model="submitForm.body"></textarea>
        </div>
      </div>

      <div class="item-5">
        <input type="submit" value="送信" class="btn" @click.prevent="contact" />
      </div>
    </div>
  </div>
</template>


<script>
export default {
  name: "team",
  data() {
    return {
      submitForm: {
        name: this.$store.state.contact.contact.name
          ? this.$store.state.contact.contact.name
          : "",
        email: this.$store.state.contact.contact.email
          ? this.$store.state.contact.contact.email
          : "",
        title: this.$store.state.contact.contact.title
          ? this.$store.state.contact.contact.title
          : "",
        body: this.$store.state.contact.contact.body
          ? this.$store.state.contact.contact.body
          : "",
        contact: true
      },
      errors: ""
    };
  },
  methods: {
    async contact() {
      const response = await axios.post("/api/contact", this.submitForm);

      // console.log(response);
      if (response.status == 422) {
        this.errors = response.data.errors;
        return;
      }

      if (response.status == 200) {
        const response = await this.$store.commit(
          "contact/setContact",
          this.submitForm
        );

        this.$router.push("/confirm");
      }
    }
  }
};
</script>

<style lang="sass" scoped>
@import '../../sass/contact.scss'
</style>