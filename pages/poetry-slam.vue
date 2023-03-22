<template>
  <div>
    <loader :title="page.title"></loader>
    <landingImage
      :backgroundImage="'moderation.png'"
      :title="page.landing.landingTitle"
      :subtitle="page.landing.landingSubtitle"
    ></landingImage>
    <component-renderer
      :component="component"
      :testimonials="testimonials"
      v-for="(component, index) in page.content"
      :key="index"
    ></component-renderer>
  </div>
</template>

<script>
import componentRenderer from "~/components/componentRenderer.vue";
export default {
  components: { componentRenderer },
  name: "IndexPage",
  layout: "default",
  async asyncData({ $content }) {
    const page = await $content("seiten", "poetry-slam").fetch();
    const testimonials = await $content("kundenmeinungen")
      .where({ category: "Poetry Slam" })
      .fetch();
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
};
</script>
