<template>
  <div class="all" v-if="!!players">
    <h2 class="main-h2">登録選手を探す</h2>
    <div class="flex">
      <div class="sideform">
        <form method="get" action>
          <label class="keyword">
            キーワード
            <input
              type="text"
              name="receive"
              class="select"
              placeholder="検索"
              v-model="searchForm.keyword"
            />
          </label>

          <span class="side-menu">プレイゲーム</span>
          <select name="game" class="game select" v-model="searchForm.game" @change="positionRank">
            <option value>指定しない</option>
            <option :value="game.id" v-for="game in games" :key="game.id">{{ game.name }}</option>
          </select>
          <span class="side-menu">ポジション</span>
          <select name="position" class="position select" v-model="searchForm.position">
            <option value class="position-0">指定しない</option>
            <option
              :value="position.id"
              v-for="position in position"
              :key="position.id"
            >{{ position.name }}</option>
          </select>

          <span class="side-menu">ランク</span>
          <select name="rank" class="rank select" v-model="searchForm.rank">
            <option value class="rank-0">指定しない</option>
            <option :value="rank.id" v-for="rank in rank" :key="rank.id">{{ rank.name }}</option>
          </select>

          <span class="side-menu">志望チーム</span>
          <select name="proama" class="proama select" v-model="searchForm.proama">
            <option value>指定しない</option>
            <option value="0">プロチーム</option>
            <option value="1">一般チーム</option>
          </select>

          <!-- <span class="side-menu">年齢</span>
            <select name="age" class="age select">
                <option value="">指定しない</option>
                @foreach($ages as $key => $age)
                <option value="{{ $key }}">{{ $age }}</option>
                @endforeach
          </select>-->

          <input type="submit" class="btn" name="pc" value="検索" @click.prevent="search" />
        </form>
      </div>

      <div class="banner-box" v-show="scout">
        <div class="banner">
          <span class="name">チームにスカウトしますか</span>
        </div>
        <div class="input-5">
          <span class="btn cancel" @click="cancel">キャンセル</span>
          <span class="btn" @click="scouts">スカウト</span>
        </div>
      </div>

      <div class="display">
        <div class="player" v-for="player in players" :key="player.id">
          <img :src="player.user.picture" alt="選手写真" class="player-img" />
          <span
            class="player-name-leader"
            :data-id="player.id"
            v-if="user.team_id != null && user.leader == 0"
            @click="scoutModal"
          >{{ player.ign }}</span>
          <span class="player-name" v-else>{{ player.ign }}</span>
          <span class="player-game">[{{ player.game.name }}]</span>
          <span class="player-position">{{ player.position.name }}</span>
          <span class="player-rank">{{ player.rank.name }}</span>
        </div>
      </div>
    </div>
    <Pagination :current-page="currentPage" :last-page="lastPage" />
  </div>
</template>

<script>
import { gamePR } from "../module/module";
import { CREATED } from "../util";
import Pagination from "../components/Pagination";

export default {
  name: "player",
  components: {
    Pagination
  },
  data() {
    return {
      searchForm: {
        game: "",
        position: "",
        rank: "",
        proama: "",
        keyword: ""
      },
      scoutForm: {
        scout: ""
      },
      players: "",
      user: "",
      games: this.$store.state.item.item.games,
      positions: this.$store.state.item.item.positions,
      position: "",
      ranks: this.$store.state.item.item.ranks,
      rank: "",
      ages: this.$store.state.item.item.ages,
      scout: false,
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
  methods: {
    async player() {
      const response = await axios.get(`/api/player/?page=${this.page}`);

      // console.log(response.data.players.data);

      this.players = response.data.players.data;
      this.currentPage = response.data.players.current_page;
      this.lastPage = response.data.players.last_page;
    },
    async users() {
      const response = await axios.get("api/user");

      // console.log("profile取得後");

      this.user = response.data;
    },
    //PositionRank
    positionRank() {
      const PR = gamePR(this.searchForm.game, this.positions, this.ranks);

      // console.log(PR);
      this.searchForm.position = "";
      this.position = PR[0].slice();
      this.searchForm.rank = "";
      this.rank = PR[1].slice();
    },
    async search() {
      const data = {
        params: {
          game: this.searchForm.game,
          position: this.searchForm.position,
          rank: this.searchForm.rank,
          proama: this.searchForm.proama
        }
      };

      const response = await axios.get(`/api/player/?page=${this.page}`, data);

      this.players = response.data.players.data;
      this.currentPage = response.data.players.current_page;
      this.lastPage = response.data.players.last_page;

      // this.searchForm.game = "";
      // this.searchForm.position = "";
      // this.searchForm.rank = "";
      // this.searchForm.proama = "";

      // this.position = [];
      // this.rank = [];

      // console.log(response.data);
    },
    scoutModal(e) {
      this.scout = true;

      const playerId = e.currentTarget.getAttribute("data-id");

      if (this.scoutForm.scout == "") {
        this.scoutForm.scout = playerId;
      }

      // console.log(this.scoutForm.scout);
    },
    cancel() {
      this.scout = false;
      this.scoutForm.scout = "";
    },
    async scouts() {
      const response = await axios.post("/api/player", this.scoutForm);

      // console.log(response);

      if (response.status == CREATED) {
        this.scout = false;
      }
    }
  },
  watch: {
    $route: {
      async handler() {
        if (
          this.searchForm.game ||
          this.searchForm.position ||
          this.searchForm.rank ||
          this.searchForm.proama
        ) {
          await this.search();
        } else {
          await this.player();
        }
        await this.users();
      },
      immediate: true
    }
  }
};
</script>


<style lang="sass" scoped>
@import '../../sass/player.scss'
</style>