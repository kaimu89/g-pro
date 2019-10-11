<template>
  <div class="all">
    <h2 class="main-h2">お問い合わせ確認</h2>

    <div class="add">
      <form action method="post">
        <div class="flex">
          <div class="item-1">
            <span class="name">名前：</span>
          </div>
          <div class="item-2">
            <span class="select1">{{contactForm.name}}</span>
          </div>
        </div>

        <div class="flex">
          <div class="item-1">
            <span class="name">メールアドレス：</span>
          </div>
          <div class="item-2">
            <span class="select1">{{contactForm.email}}</span>
          </div>
        </div>

        <div class="flex">
          <div class="item-1">
            <span class="name">お問い合わせ名：</span>
          </div>
          <div class="item-2">
            <span class="select1">{{contactForm.title}}</span>
          </div>
        </div>

        <div class="flex">
          <div class="item-1">
            <span class="name">お問い合わせ内容：</span>
          </div>
          <div class="item-2">
            <span class="select1">{{contactForm.body}}</span>
          </div>
        </div>

        <div class="item-5">
          <router-link to="/contact" class="cancel btn">戻る</router-link>
          <input type="submit" value="送信" class="btn" @click.prevent="submit" />
        </div>
      </form>
    </div>
  </div>
</template>


<script>
export default {
  name: "team",
  data() {
    return {
      contactForm: {
        name: this.$store.state.contact.contact.name,
        email: this.$store.state.contact.contact.email,
        title: this.$store.state.contact.contact.title,
        body: this.$store.state.contact.contact.body,
        confirm: true
      }
    };
  },
  methods: {
    async submit() {
      const response = await axios.post("/api/contact", this.contactForm);

      // console.log(response.data);

      if (response.status == 200) {
        const response = await this.$store.commit("contact/setNull");

        this.$router.push("/contact");
      }
    }
  }
};
</script>

<style scoped>
.select {
  border: solid 1px white;
}
</style>

<style lang="sass" scoped>

@import '../../sass/contact.scss'

</style>