<template>
  <div class="all" v-if="games">
    <div class="add">
      <h2 class="main-h2">登録</h2>

      <h3 class="title">チーム登録</h3>

      <div class="error-pc" v-if="errors.name">
        <small class="small">※{{errors.name[0]}}</small>
      </div>
      <div class="flex">
        <div class="item-1">
          <span class="name">チーム名：</span>
          <div class="error-mob" v-if="errors.name">
            <small class="small">※{{errors.name[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <input type="text" name="name" class="select" v-model="createForm.name" />
        </div>
      </div>

      <div class="error-pc" v-if="errors.file">
        <small class="small">※{{errors.file[0]}}</small>
      </div>
      <div class="flex">
        <div class="item-1">
          <span class="name">チームロゴ：</span>
          <div class="error-mob" v-if="errors.file">
            <small class="small">※{{errors.file[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <input type="file" name="file" class="file" accept="image/*" @change="selectedFile" />
        </div>
      </div>

      <div class="error-pc" v-if="errors.proama">
        <small class="small">※{{errors.proama[0]}}</small>
      </div>
      <div class="flex">
        <div class="item-1">
          <span class="name">チーム種類：</span>
          <div class="error-mob" v-if="errors.proama">
            <small class="small">※{{errors.proama[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <label class="radio1">
            プロ
            <input
              type="radio"
              name="proama"
              value="0"
              v-model="createForm.proama"
              @change="change"
            />
          </label>
          <span>|</span>
          <label class="radio2">
            一般
            <input
              type="radio"
              name="proama"
              value="1"
              v-model="createForm.proama"
              @change="change"
            />
          </label>
        </div>
      </div>

      <div class="error-pc" v-if="errors.pro_game && createForm.proama=='0'">
        <small class="small">※{{errors.pro_game[0]}}</small>
      </div>
      <div class="flex pro-title" v-show="createForm.proama == '0'">
        <div class="item-1">
          <span class="name">ゲームタイトル：</span>
          <div class="error-mob" v-if="errors.pro_game && createForm.proama=='0'">
            <small class="small">※{{errors.pro_game[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <div class="selectbox">
            <label v-for="game in games" :key="game.id">
              {{ game.name }}
              <input
                type="checkbox"
                name="pro_game[]"
                :value="game.id"
                v-model="createForm.pro_game"
              />
            </label>
          </div>
        </div>
      </div>

      <div class="error-pc" v-if="errors.ama_game && createForm.proama==1">
        <small class="small">※{{errors.ama_game[0]}}</small>
      </div>
      <div class="flex ama-title" v-show="createForm.proama == 1">
        <div class="item-1">
          <span class="name">ゲームタイトル：</span>
          <div class="error-mob" v-if="errors.ama_game && createForm.proama==1">
            <small class="small">※{{errors.ama_game[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <select name="ama_game" class="game select" v-model="createForm.ama_game">
            <option value>未選択</option>
            <option :value="game.id" v-for="game in games" :key="game.id">{{ game.name }}</option>
          </select>
        </div>
      </div>

      <div class="error-pc" v-if="errors.pro_top && createForm.proama=='0'">
        <small class="small">※{{errors.pro_top[0]}}</small>
      </div>
      <div class="flex pro-top" v-show="createForm.proama == '0'">
        <div class="item-1">
          <span class="name">チーム代表名：</span>
          <div class="error-mob" v-if="errors.pro_top && createForm.proama=='0'">
            <small class="small">※{{errors.pro_top[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <input type="text" name="pro_top" class="select" v-model="createForm.pro_top" />
        </div>
      </div>

      <div class="error-pc" v-if="errors.ama_top && createForm.proama==1">
        <small class="small">※{{errors.ama_top[0]}}</small>
      </div>
      <div class="flex ama-top" v-show="createForm.proama == 1">
        <div class="item-1">
          <span class="name">リーダー名：</span>
          <div class="error-mob" v-if="errors.ama_top && createForm.proama==1">
            <small class="small">※{{errors.ama_top[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <input type="text" name="ama_top" class="select" v-model="createForm.ama_top" />
        </div>
      </div>

      <div class="error-pc" v-if="errors.hp && createForm.proama=='0'">
        <small class="small">※{{errors.hp[0]}}</small>
      </div>
      <div class="flex pro-hp" v-show="createForm.proama == '0'">
        <div class="item-1">
          <span class="name">チームHP：</span>
          <div class="error-mob" v-if="errors.hp && createForm.proama=='0'">
            <small class="small">※{{errors.hp[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <input type="text" name="hp" class="select" v-model="createForm.hp" />
        </div>
      </div>

      <div class="error-pc" v-if="errors.email">
        <small class="small">※{{errors.email[0]}}</small>
      </div>
      <div class="flex">
        <div class="item-1">
          <span class="name">チーム連絡先：</span>
          <div class="error-mob" v-if="errors.email">
            <small class="small">※{{errors.email[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <input
            type="text"
            name="email"
            class="select"
            placeholder="example@〇〇〇.〇〇"
            v-model="createForm.email"
          />
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
            cols="35"
            name="description"
            rows="10"
            class="body"
            v-model="createForm.description"
          ></textarea>
        </div>
      </div>

      <div class="item-5">
        <input type="submit" value="登録" class="btn" @click.prevent="create" />
      </div>
    </div>
  </div>
</template>

<script>
import { gamePR } from "../module/module";
// import { nextTick } from "q";
// import { mkdir } from "fs";
export default {
  name: "addTeam",
  data() {
    return {
      createForm: {
        name: "",
        proama: "",
        pro_top: "",
        ama_top: "",
        hp: "",
        email: "",
        description: "",
        pro_game: [],
        ama_game: "",
        file: ""
      },
      errors: "",
      games: this.$store.state.item.item.games,
      game: ""
    };
  },
  computed: {},
  methods: {
    selectedFile(e) {
      // 選択された File の情報を保存しておく
      e.preventDefault();
      let files = e.target.files;

      // console.log("files");
      // console.log(files);

      this.createForm.file = files[0];

      // console.log("files[0]");
      // console.log(files[0]);

      // console.log(this.createForm.file);
    },
    async create() {
      let formData = new FormData();
      formData.append("file", this.createForm.file);
      formData.append("name", this.createForm.name);
      formData.append("proama", this.createForm.proama);
      formData.append("pro_top", this.createForm.pro_top);
      formData.append("ama_top", this.createForm.ama_top);
      formData.append("hp", this.createForm.hp);
      formData.append("email", this.createForm.email);
      formData.append("description", this.createForm.description);
      formData.append("pro_game", this.createForm.pro_game);
      formData.append("ama_game", this.createForm.ama_game);

      const response = await axios.post("/api/add/team", formData);

      // console.log(response);

      if (response.status == 422) {
        this.errors = response.data.errors;
        return;
      }

      if (response.status == 201) {
        this.$router.push("/myteam");
      }
    },
    change() {
      //プロとアマのradioを切り替えた際にその選択していた項目をリセットする処理
      if (this.createForm.proama == "0") {
        this.createForm.ama_game = "";
        this.createForm.ama_top = "";
      }
      if (this.createForm.proama == 1) {
        this.createForm.pro_game = [];
        this.createForm.pro_top = "";
        this.createForm.hp = "";
      }
    }
  },
  beforeRouteEnter(route, redirect, next) {
    async function middleware() {
      const response = await axios.get("/api/user");

      const user = response.data;

      // console.log(response.data);

      if (!!user.team) {
        if (user.leader == "0") {
          return next("/add/pro");
        } else if (user.leader == null) {
          return next("/myteam");
        }
      } else if (!!user.child) {
        return next("/myteam");
      }
      return next();
    }

    middleware();
  }
};
</script>


<style lang="sass" scoped>
@import '../../sass/add.scss'
</style>