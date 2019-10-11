
<template>
  <div class="links">
    <ul class="pagination">
      <!-- Previous Page Link -->
      <li class="page-item disabled" v-if="isFirstPage">
        <span class="page-link">&lsaquo;</span>
      </li>

      <li class="page-item" v-if="!isFirstPage">
        <RouterLink :to="`?page=${currentPage - 1}`" class="page-link">&lsaquo;</RouterLink>
      </li>

      <!-- Pagination Elements -->
      <li
        class="page-item"
        :class="{active: currentPage == page}"
        v-for="page in displayList"
        :key="page"
      >
        <router-link class="page-link" :to="`?page=${page}`" v-if="currentPage != page">{{page}}</router-link>
        <span class="page-link" v-if="currentPage == page">
          {{
          page }}
        </span>
      </li>

      <!-- Next Page Link -->
      <li class="page-item" v-if="!isLastPage">
        <RouterLink :to="`page=${currentPage + 1}`" class="page-link">&rsaquo;</RouterLink>
      </li>

      <li class="page-item disabled" v-if="isLastPage">
        <span class="page-link">&rsaquo;</span>
      </li>

      <!-- <RouterLink v-if="! isFirstPage" :to="`?page=${currentPage - 1}`" class="button">&laquo; prev</RouterLink>
      <RouterLink v-if="! isLastPage" :to="`?page=${currentPage + 1}`" class="button">next &raquo;</RouterLink>-->
    </ul>
  </div>
</template>

<script>
export default {
  props: {
    currentPage: {
      type: Number,
      required: true
    },
    lastPage: {
      type: Number,
      required: true
    }
  },
  data() {
    return {};
  },
  computed: {
    isFirstPage() {
      return this.currentPage === 1;
    },
    isLastPage() {
      return this.currentPage === this.lastPage;
    },
    displayList() {
      let first = this.currentPage - 4;
      if (first < 1) first = 1;

      let last = this.currentPage + 4;
      if (last > this.lastPage) last = this.lastPage;

      const list = [];
      for (let i = first; i <= last; i++) {
        list.push(i);
      }
      return list;
    }
  }
};
</script>

<style lang="sass" scoped>
@import '../../sass/pagination.scss'
</style>