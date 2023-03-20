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
              <p>{{ testimonial.text }}</p>
              <h4>{{ testimonial.name }}</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="slider-controls">
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
  data() {
    return {
      testimonials: [
        {
          name: "John Doe",
          image: "path/to/image1.jpg",
          text: "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
          position: "CEO",
        },
        {
          name: "Jane Doe",
          image: "path/to/image2.jpg",
          text: "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.",
          position: "CTO",
        },
        {
          name: "Bob Smith",
          image: "path/to/image3.jpg",
          text: "Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.",
          position: "COO",
        },
      ],
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
      let width;
      if(window.innerWidth < 900) {
        width = this.testimonials.length * 100;
      } else {
        width = this.testimonials.length * this.slideWidth;
      }
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