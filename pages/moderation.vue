<template>
  <div>
    <loader :title="page.title"></loader>
    <landingImage
      :backgroundImage="page.landing.landingImage"
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
    const page = await $content("seiten", "moderation").fetch();
    const testimonials = await $content("kundenmeinungen")
      .where({ category: "Moderation" })
      .fetch();
    return { page, testimonials };
  },
  data() {
    return {
    };
  },
};
</script>
