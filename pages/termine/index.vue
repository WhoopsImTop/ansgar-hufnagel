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
    const page = await $content("seiten", "termine").fetch();
    const testimonials = await $content("kundenmeinungen")
      .where({ category: "Termine" })
      .fetch();
    let termine = await $content("termine").fetch();
    //remove termine that are in the past of today
    termine = termine.filter((termin) => {
      return new Date(termin.date) >= new Date();
    });
    termine.sort((a, b) => {
      return new Date(a.date) - new Date(b.date);
    });
    return { page, testimonials, termine };
  },
  data() {
    return {};
  },
};
</script>
