<template>
  <div class="all" v-if="recruits">
    <h2 class="main-h2">チームを探す</h2>
    <div class="search">
      <form method="get" action>
        <div class="flex">
          <div class="selectTeam">
            <span class="sub">チーム</span>
            <label class="adj">
              プロ
              <input
                type="checkbox"
                name="pro"
                value="true"
                class="check1 pc-pro"
                v-model="searchForm.pro"
              />
            </label>
            <label>
              一般
              <input
                type="checkbox"
                name="ama"
                value="true"
                class="check2 pc-ama"
                v-model="searchForm.ama"
              />
            </label>

            <span class="sub">チームを選択</span>
            <select name="team" class="team select" v-model="searchForm.team">
              <option value class="team-0">指定しない</option>
              <option v-for="team in teams" :key="team.id" :value="team.id">{{team.name}}</option>
            </select>

            <span class="sub">募集職種</span>
            <label class="adj">
              選手
              <input
                type="checkbox"
                name="player"
                value="true"
                class="check1"
                v-model="searchForm.player"
              />
            </label>
            <label>
              スタッフ
              <input
                type="checkbox"
                name="staff"
                value="true"
                class="check2"
                v-model="searchForm.staff"
              />
            </label>
          </div>

          <div class="gamebox">
            <span class="sub">プレイゲーム</span>
            <select
              name="game"
              class="game select"
              v-model="searchForm.game"
              @change="positionRank"
            >
              <option value>指定しない</option>
              <option :value="game.id" v-for="game in games" :key="game.id">{{ game.name }}</option>
            </select>

            <span class="sub">ポジション</span>
            <select name="position" class="position select" v-model="searchForm.position">
              <option value class="position-0">指定しない</option>
              <option
                :value="position.id"
                v-for="position in position"
                :key="position.id"
              >{{ position.name }}</option>
            </select>

            <span class="sub">ランク</span>
            <select name="rank" class="rank select" v-model="searchForm.rank">
              <option value class="rank-0">指定しない</option>
              <option :value="rank.id" v-for="rank in rank" :key="rank.id">{{ rank.name }}</option>
            </select>
          </div>

          <div class="other">
            <span class="sub">年齢</span>
            <select name="age" class="age select" v-model="searchForm.age">
              <option v-for="(age,index) in ages" :key="index" :value="index">{{age}}</option>
            </select>

            <span class="sub">ゲーミングハウス</span>
            <select name="house" class="house select" v-model="searchForm.house">
              <option value>指定しない</option>
              <option value="0" class="house-op" v-show="house">あり</option>
              <option value="1" class="house-op" v-show="house">なし</option>
            </select>
          </div>
        </div>
        <div class="submit">
          <input type="submit" class="btn" name="pc" value="検索" @click.prevent="search" />
        </div>
      </form>
    </div>

    <div class="banner-box confirm none">
      <div class="banner">
        <span class="name">応募を送信しますか？</span>
      </div>
      <div class="input-5">
        <span class="btn cancel">キャンセル</span>
        <span class="btn ok" onclick>応募する</span>

        <form id="oubo-submit" action method="POST" style="display: none;">
          <input type="hidden" name="oubo" class="oubo-input" />
        </form>
      </div>
    </div>

    <div class="display">
      <div class="recruit" v-for="recruit in recruits" :key="recruit.id">
        <div class="main-name">
          <span class="rec-name">チーム名：{{ recruit.team.name }}</span>
          <span class="rec-proama">チーム：プロチーム</span>
          <span class="rec-proama">チーム：一般チーム</span>
        </div>
        <div class="GJ">
          <span class="rec-game">ゲームタイトル：{{ recruit.game.name }}</span>
          <span class="rec-job" v-if="recruit.staff_id == null">募集職種：選手</span>
          <span class="rec-job" v-else>募集職種：スタッフ({{ recruit.staff.name }})</span>
        </div>
        <div class="PR">
          <span class="rec-cont" v-if="recruit.staff_id != null">仕事内容：{{ recruit.content }}</span>
          <span class="rec-posi" v-if="recruit.staff_id == null">ポジション：{{ recruit.position.name }}</span>
          <span class="rec-rank" v-if="recruit.staff_id == null">ランク：{{ recruit.rank.name }}</span>
        </div>
        <div class="letter">
          <span class="rec-ab" v-if="recruit.staff_id != null">必須スキル：{{ recruit.ab_skill }}</span>
          <span class="rec-wel" v-if="recruit.staff_id != null">歓迎スキル：{{ recruit.wel_skill }}</span>
          <span class="rec-age" v-if="recruit.staff_id == null">年齢：{{ recruit.age }}</span>
          <span class="rec-house" v-if="recruit.staff_id == null">ｹﾞｰﾐﾝｸﾞﾊｳｽ：{{ recruit.house }}</span>
          <span class="rec-leader" v-if="recruit.staff_id == null">リーダー名：{{ recruit.team.top }}</span>
        </div>
        <span class="rec-des">説明文：{{ recruit.description }}</span>

        <div class="item-5">
          <span class="btn oubo" :data-id="recruit.id">応募する</span>
        </div>
      </div>
    </div>
    <Pagination :search-form="searchForm" :current-page="currentPage" :last-page="lastPage" />
  </div>
</template>

<script>
import { gamePR } from "../module/module";
import Pagination from "../components/Pagination";
export default {
  name: "findteam",
  components: {
    Pagination
  },
  data() {
    return {
      searchForm: {
        pro: "",
        ama: "",
        team: "",
        player: "",
        staff: "",
        game: "",
        position: "",
        rank: "",
        age: 0,
        house: ""
      },
      allTeams: "",
      recruits: "",
      games: this.$store.state.item.item.games,
      positions: this.$store.state.item.item.positions,
      position: "",
      ranks: this.$store.state.item.item.ranks,
      rank: "",
      ages: this.$store.state.item.item.ages,
      house: "",
      currentPage: 0,
      lastPage: 0
    };
  },
  props: {
    page: {
      type: Number,
      required: true
    }
  },
  computed: {
    teams() {
      let pro = this.searchForm.pro;
      let ama = this.searchForm.ama;
      if (pro && ama) {
        this.searchForm.team = "";
        this.searchForm.house = "";
        this.house = true;
        return this.allTeams;
      } else if (pro && !ama) {
        this.searchForm.team = "";
        this.searchForm.house = "";
        this.house = true;
        return this.allTeams.filter(team => team.proama == 0);
      } else if (!pro && ama) {
        this.searchForm.team = "";
        this.searchForm.house = "";
        this.house = false;
        return this.allTeams.filter(team => team.proama == 1);
      } else if (!pro && !ama) {
        this.searchForm.team = "";
        this.searchForm.house = "";
        this.house = false;
        return "";
      }
    }
  },
  methods: {
    async recruit() {
      const response = await axios.get(`/api/findteam/?page=${this.page}`);

      // console.log(response.data);
      this.recruits = response.data.recruits.data;
      this.currentPage = response.data.recruits.current_page;
      this.lastPage = response.data.recruits.last_page;
    },
    async team() {
      const response = await axios.get("/api/item/team");
      this.allTeams = response.data;
    },
    positionRank() {
      const PR = gamePR(this.searchForm.game, this.positions, this.ranks);
      this.position = PR[0].slice();
      this.searchForm.position = "";
      this.rank = PR[1].slice();
      this.searchForm.rank = "";
    },
    async search() {
      const data = {
        params: {
          pro: this.searchForm.pro,
          ama: this.searchForm.ama,
          team: this.searchForm.team,
          player: this.searchForm.player,
          staff: this.searchForm.staff,
          game: this.searchForm.game,
          position: this.searchForm.position,
          rank: this.searchForm.rank,
          age: this.searchForm.age,
          house: this.searchForm.house
        }
      };
      const response = await axios.get(
        `/api/findteam/?page=${this.page}`,
        data
      );

      this.recruits = response.data.recruits.data;
      this.currentPage = response.data.recruits.current_page;
      this.lastPage = response.data.recruits.last_page;

      // this.searchForm.pro = "";
      // this.searchForm.ama = "";
      // this.searchForm.team = "";
      // this.searchForm.player = "";
      // this.searchForm.staff = "";
      // this.searchForm.game = "";
      // this.searchForm.position = "";
      // this.searchForm.rank = "";
      // this.searchForm.age = 0;
      // this.searchForm.house = "";

      // this.position = [];
      // this.rank = [];

      // console.log(response.data);
    }
  },
  watch: {
    $route: {
      async handler() {
        if (
          this.searchForm.pro ||
          this.searchForm.ama ||
          this.searchForm.team ||
          this.searchForm.player ||
          this.searchForm.staff ||
          this.searchForm.game ||
          this.searchForm.position ||
          this.searchForm.rank ||
          this.searchForm.age ||
          this.searchForm.house
        ) {
          await this.search();
        } else {
          await this.recruit();
        }
        await this.team();
      },
      immediate: true
    }
  }
};
</script>

<style lang="sass" scoped>
@import '../../sass/findteam.scss'
</style>
