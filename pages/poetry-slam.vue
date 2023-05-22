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
  head() {
    return {
      title: 'Ansgar Hufnagel | ' + this.page.title,
      meta: [
        {
          hid: "description",
          name: "description",
          content: this.page.description,
        },
        {
          hid: "og:title",
          property: "og:title",
          content: this.page.title,
        },
        {
          hid: "og:description",
          property: "og:description",
          content: this.page.description,
        },
        {
          hid: "og:image",
          property: "og:image",
          content: this.page.landing.landingImage,
        },
        {
          hid: "og:url",
          property: "og:url",
          content: "https://www.ansgar-hufnagel.de",
        },
        {
          hid: "og:type",
          property: "og:type",
          content: "website",
        },
        {
          hid: "og:locale",
          property: "og:locale",
          content: "de_DE",
        },
      ],
    };
  },
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
    };
  },
};
</script>
