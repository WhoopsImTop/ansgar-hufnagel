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
      :termine="termine"
      v-for="(component, index) in page.content"
      :termineLimit="5"
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
    termine.sort((a, b) => {
      return new Date(a.date) - new Date(b.date);
    });
    termine.forEach((termin, index) => {
      if (new Date(termin.date) < new Date()) {
        termine.splice(index, 1);
      }
    });
    return { page, testimonials, termine };
  },
  data() {
    return {};
  },
};
</script>
