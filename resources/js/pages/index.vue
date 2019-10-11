<template>
  <div>
    <!-- swiper1 -->
    <swiper :options="swiperOptionTop" class="gallery-top" ref="swiperTop">
      <swiper-slide class="slide-1 screen"></swiper-slide>
      <swiper-slide class="slide-2 screen"></swiper-slide>
      <swiper-slide class="slide-3 screen"></swiper-slide>
      <swiper-slide class="slide-4 screen"></swiper-slide>
      <swiper-slide class="slide-5 screen"></swiper-slide>
      <div class="swiper-button-next swiper-button-white" slot="button-next"></div>
      <div class="swiper-button-prev swiper-button-white" slot="button-prev"></div>
    </swiper>
    <!-- swiper2 Thumbs -->
    <swiper :options="swiperOptionThumbs" class="gallery-thumbs" ref="swiperThumbs">
      <swiper-slide class="slide-1 mini"></swiper-slide>
      <swiper-slide class="slide-2 mini"></swiper-slide>
      <swiper-slide class="slide-3 mini"></swiper-slide>
      <swiper-slide class="slide-4 mini"></swiper-slide>
      <swiper-slide class="slide-5 mini"></swiper-slide>
    </swiper>
  </div>
</template>

<script>
import "swiper/dist/css/swiper.css";
import { swiper, swiperSlide, mdCardMedia } from "vue-awesome-swiper";
export default {
  components: {
    swiper,
    swiperSlide
  },
  data() {
    return {
      swiperOptionTop: {
        spaceBetween: 10,
        loop: true,
        loopedSlides: 5, //looped slides should be the same
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev"
        }
      },
      swiperOptionThumbs: {
        spaceBetween: 10,
        slidesPerView: 4,
        touchRatio: 0.2,
        loop: true,
        loopedSlides: 5, //looped slides should be the same
        slideToClickedSlide: true
      }
    };
  },
  mounted() {
    this.$nextTick(() => {
      const swiperTop = this.$refs.swiperTop.swiper;
      const swiperThumbs = this.$refs.swiperThumbs.swiper;
      swiperTop.controller.control = swiperThumbs;
      swiperThumbs.controller.control = swiperTop;
    });
  }
};
</script>

<style lang="sass" scoped>
@import '../../sass/index.scss'
</style>

