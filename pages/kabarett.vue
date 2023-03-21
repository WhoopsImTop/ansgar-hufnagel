<template>
  <div>
    <div class="loader">
      <div class="content-container">
        <div class="text-container">
          <h1>{{ page.title }}</h1>
        </div>
      </div>
    </div>
    <landingImage
      :backgroundImage="'moderation.png'"
      :title="page.landing.landingTitle"
      :subtitle="page.landing.landingSubtitle"
    ></landingImage>
    <component-renderer :component="component" :testimonials="testimonials" v-for="(component, index) in page.content" :key="index"></component-renderer>
  </div>
</template>

<script>
import componentRenderer from '~/components/componentRenderer.vue';
export default {
  components: { componentRenderer },
  name: "IndexPage",
  layout: "default",
  async asyncData({ $content }) {
    const page = await $content("seiten", "kabarett").fetch();
    const testimonials = await $content("kundenmeinungen").where({ category: "Kabarett" }).fetch();
    return { page, testimonials };
  },
  data() {
    return {
      cards: [
        {
          cardImage: "moderation.png",
          cardTitle: "Moderation",
          cardText: "asdf",
        },
        {
          cardImage: "moderation.png",
          cardTitle: "Moderation",
          cardText: "asdf",
          cardActionBtnText: "asdf",
          cardActionBtnLink: "/",
        },
        {
          cardImage: "moderation.png",
          cardTitle: "Moderation",
          cardText: "asdf",
        },
      ],
    };
  },
  created () {
    setTimeout(() => {
      document.querySelector('.loader').style.opacity = 0;
    }, 1000)
    setTimeout(() => {
      document.querySelector('.loader').style.display = 'none';
    }, 1200)
  }
};
</script>
