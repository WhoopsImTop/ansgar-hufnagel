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
      :termine="termine"
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
    const page = await $content("seiten", "index").fetch();
    const testimonials = await $content("kundenmeinungen")
      .where({ category: "Generell" })
      .fetch();
    const termine = await $content("termine").fetch();
    return { page, testimonials, termine };
  },
  data() {
    return {};
  },
};
</script>
