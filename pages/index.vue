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
  head() {
    return {
      title: this.page.title,
      meta: [
        {
          hid: "description",
          name: "description",
          content: this.page.landing.landingSubtitle,
        },
        {
          hid: "og:title",
          property: "og:title",
          content: 'Moderation, Poetry Slam, Kabarett, Workshops, Musik'
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
        {
          hid: "og:site_name",
          property: "og:site_name",
          content: "Moderation und mehr",
        },
        {
          hid: "twitter:title",
          property: "twitter:title",
          content: this.page.title,
        },
        {
          hid: "twitter:description",
          property: "twitter:description",
          content: this.page.description,
        },
        {
          hid: "twitter:image",
          property: "twitter:image",
          content: this.page.landing.landingImage,
        },
      ],
    };
  },
  async asyncData({ $content }) {
    const page = await $content("seiten", "index").fetch();
    const testimonials = await $content("kundenmeinungen")
      .where({ category: "Generell" })
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
