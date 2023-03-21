<template>
  <div class="testimonial-slider">
    <div class="slider-wrapper" ref="slider">
      <div class="slider" :style="sliderStyles">
        <div
          class="slide"
          v-for="(testimonial, index) in testimonials"
          :key="index"
        >
          <div class="testimonial">
            <div class="testimonial-image">
              <img :src="testimonial.image" :alt="testimonial.name" />
            </div>
            <div class="testimonial-text">
              <nuxt-content :document="testimonial"></nuxt-content>
              <h4 style="margin-top: 15px">{{ testimonial.company }}</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="slider-controls" v-if="testimonials.length > slidesToShow">
        <div
            class="slide-circle"
            v-for="(testimonial, index) in testimonials"
            :key="index"
            :class="{ active: index === currentSlide }"
            @click="index === currentSlide ? nextSlide() : currentSlide = index"
        ></div>
    </div>
  </div>
</template>
  
  <script>
export default {
  props: ['testimonials'],
  data() {
    return {
      currentSlide: 0,
      slidesToShow: 2,
      slideWidth: null,
    };
  },
  mounted() {
    this.slideWidth = this.$refs.slider.offsetWidth / this.slidesToShow;
  },
  computed: {
    sliderStyles() {
      let width = this.testimonials.length * this.slideWidth;
      return {
        transform: `translateX(-${this.currentSlide * width}px)`,
      };
    },
  },
  methods: {
    nextSlide() {
      console.log("width: " + this.slideWidth);
      if (this.currentSlide < this.testimonials.length - this.slidesToShow) {
        this.currentSlide++;
      }
    },
    prevSlide() {
      if (this.currentSlide > 0) {
        this.currentSlide--;
      }
    },
  },
};
</script>
  
<style>
</style>