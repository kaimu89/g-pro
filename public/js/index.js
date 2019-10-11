$(function(){
   $('.screen').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  fade: true,
  asNavFor: '.ads',
  prevArrow: '<div class="prev"><span class="slide-arrow prev-arrow">＜</span></div>',
    nextArrow: '<div class="next"><span class="slide-arrow next-arrow">＞</span></div>'
});
    
$('.ads').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  arrows: false,
  asNavFor: '.screen',
  centerMode: true,
  focusOnSelect: true,
    swipe: false
});
    
    
    
});