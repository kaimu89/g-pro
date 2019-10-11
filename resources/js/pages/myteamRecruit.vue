<template>
  <div class="all" v-if="!!team.name">
    <h2 class="main-h2">マイチーム募集編集</h2>

    <div class="add">
      <h3 class="title">スタッフ</h3>
      <!-- 
      <h3 class="title">プロチーム</h3>

      <h3 class="title">プロチーム</h3>-->

      <div class="flex">
        <div class="item-1">
          <span class="name">チーム名：</span>
        </div>
        <div class="item-2">
          <span class="text">{{team.name}}</span>
        </div>
      </div>

      <div class="flex">
        <div class="item-1">
          <span class="name">チームタイトル名：</span>
        </div>
        <div class="item-2">
          <span class="text">{{game.name}}</span>
        </div>
      </div>

      <div class="error-pc" v-if="errors.position_id">
        <small class="small">※{{errors.position_id[0]}}</small>
      </div>
      <div class="flex" v-if="!!recruit.position_id && !!recruit.rank_id">
        <div class="item-1">
          <span class="name">ポジション：</span>
          <div class="error-mob" v-if="errors.position_id">
            <small class="small">※{{errors.position_id[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <select class="select" v-model="editForm.position_id">
            <option
              v-for="position in position"
              :key="position.id"
              :value="position.id"
            >{{position.name}}</option>
          </select>
        </div>
      </div>

      <div class="error-pc" v-if="errors.rank_id">
        <small class="small">※{{errors.rank_id[0]}}</small>
      </div>
      <div class="flex" v-if="!!recruit.position_id && !!recruit.rank_id">
        <div class="item-1">
          <span class="name">ランク：</span>
          <div class="error-mob" v-if="errors.rank_id">
            <small class="small">※{{errors.rank_id[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <select class="select" v-model="editForm.rank_id">
            <option v-for="rank in rank" :key="rank.id" :value="rank.id">{{rank.name}}</option>
          </select>
        </div>
      </div>

      <div class="error-pc" v-if="errors.age">
        <small class="small">※{{errors.age[0]}}</small>
      </div>
      <div class="flex" v-if="!!recruit.position_id && !!recruit.rank_id && proama == '0'">
        <div class="item-1">
          <span class="name">年齢：</span>
          <div class="error-mob" v-if="errors.age">
            <small class="small">※{{errors.age[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <select class="select" v-model="editForm.age">
            <option v-for="(age,name) in ages" :key="name" :value="name">{{age}}</option>
          </select>
        </div>
      </div>

      <div class="error-pc" v-if="errors.house">
        <small class="small">※{{errors.house[0]}}</small>
      </div>
      <div class="flex" v-if="!!recruit.position_id && !!recruit.rank_id && proama == '0'">
        <div class="item-1">
          <span class="name">ゲーミングハウス：</span>
          <div class="error-mob" v-if="errors.house">
            <small class="small">※{{errors.house[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <label class="radio1">
            あり
            <input type="radio" value="0" :checked="yes" v-model="editForm.house" />
          </label>
          <span>|</span>
          <label class="radio2">
            なし
            <input type="radio" value="1" :checked="no" v-model="editForm.house" />
          </label>
        </div>
      </div>

      <div class="error-pc" v-if="errors.staff_id">
        <small class="small">※{{errors.staff_id[0]}}</small>
      </div>
      <div class="flex" v-if="!!recruit.staff_id">
        <div class="item-1">
          <span class="name">職種：</span>
          <div class="error-mob" v-if="errors.staff_id">
            <small class="small">※{{errors.staff_id[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <select class="select" v-model="editForm.staff_id">
            <option v-for="staff in staffs" :key="staff.id" :value="staff.id">{{staff.name}}</option>
          </select>
        </div>
      </div>

      <div class="error-pc" v-if="errors.content">
        <small class="small">※{{errors.content[0]}}</small>
      </div>
      <div class="flex" v-if="!!recruit.staff_id">
        <div class="item-1">
          <span class="name">仕事内容：</span>
          <div class="error-mob" v-if="errors.content">
            <small class="small">※{{errors.content[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <input type="text" class="select" v-model="editForm.content" />
        </div>
      </div>

      <div class="error-pc" v-if="errors.ab_skill">
        <small class="small">※{{errors.ab_skill[0]}}</small>
      </div>
      <div class="flex" v-if="!!recruit.staff_id">
        <div class="item-1">
          <span class="name">必須スキル：</span>
          <div class="error-mob" v-if="errors.ab_skill">
            <small class="small">※{{errors.ab_skill[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <input type="text" class="select" v-model="editForm.ab_skill" />
        </div>
      </div>

      <div class="error-pc" v-if="errors.wel_skill">
        <small class="small">※{{errors.wel_skill[0]}}</small>
      </div>
      <div class="flex" v-if="!!editForm.staff_id">
        <div class="item-1">
          <span class="name">歓迎スキル：</span>
          <div class="error-mob" v-if="errors.wel_skill">
            <small class="small">※{{errors.wel_skill[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <input type="text" class="select" v-model="editForm.wel_skill" />
        </div>
      </div>

      <div class="error-pc" v-if="errors.description">
        <small class="small">※{{errors.description[0]}}</small>
      </div>
      <div class="flex">
        <div class="item-1">
          <span class="name">募集文：</span>
          <div class="error-mob" v-if="errors.description">
            <small class="small">※{{errors.description[0]}}</small>
          </div>
        </div>
        <div class="item-2">
          <textarea cols="35" rows="10" class="body" v-model="editForm.description"></textarea>
        </div>
      </div>

      <div class="item-5">
        <router-link to="/myteam" class="btn cancel">戻る</router-link>
        <input type="submit" value="変更" class="btn" @click.prevent="edit" />
      </div>
    </div>
  </div>
</template>

<script>
import { objectKey } from "../module/module";

export default {
  name: "myteamRecruit",
  props: {
    id: Number
  },
  data() {
    return {
      editForm: {
        position_id: "",
        rank_id: "",
        age: "",
        house: "",
        description: "",
        staff_id: "",
        content: "",
        ab_skill: "",
        wel_skill: "",
        id: this.id
      },
      recruit: "",
      yes: "",
      no: "",
      team: "",
      game: "",
      proama: "",
      staffs: this.$store.state.item.item.staffs,
      positions: this.$store.state.item.item.positions,
      ranks: this.$store.state.item.item.ranks,
      ages: this.$store.state.item.item.ages,
      errors: ""
    };
  },
  computed: {
    position() {
      const positions = this.positions.filter(x => {
        return x.game_id == this.game.id;
      });
      return positions;
    },
    rank() {
      const ranks = this.ranks.filter(x => {
        return x.game_id == this.game.id;
      });
      return ranks;
    }
  },
  methods: {
    async recruits() {
      const response = await axios.get(`/api/myteam/recruit/${this.id}`);

      console.log(response.data);

      this.recruit = response.data;

      this.editForm.position_id = response.data.position_id;
      this.editForm.rank_id = response.data.rank_id;
      this.editForm.age = response.data.age;
      this.editForm.house = response.data.house;
      this.editForm.description = response.data.description;
      this.editForm.staff_id = response.data.staff_id;
      this.editForm.content = response.data.content;
      this.editForm.ab_skill = response.data.ab_skill;
      this.editForm.wel_skill = response.data.wel_skill;

      this.proama = response.data.team.proama;

      this.yes = response.data.house == 0 ? true : false;
      this.no = response.data.house == 1 ? true : false;

      this.team = response.data.team;
      this.game = response.data.game;
    },
    async edit() {
      const response = await axios.post(
        `/api/myteam/recruit/${this.id}`,
        this.editForm
      );

      // console.log(response.data);

      if (response.status == 422) {
        this.errors = response.data.errors;
        return;
      }

      if (response.status == 200) {
        this.$router.push("/myteam");
      }
    }
  },
  watch: {
    $route: {
      async handler() {
        await this.recruits();
      },
      immediate: true
    }
  }
};
</script>

<style lang="sass" scoped>
@import '../../sass/recruit.scss'
</style>