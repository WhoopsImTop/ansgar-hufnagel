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
  head() {
    return {
      title: "Ansgar Hufnagel | " + this.page.title,
      meta: [
        {
          hid: "description",
          name: "description",
          content: this.page.landing.landingSubtitle,
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
  name: "IndexPage",
  layout: "default",
  async asyncData({ $content }) {
    const page = await $content("seiten", "booking").fetch();
    const testimonials = await $content("kundenmeinungen")
      .where({ category: "Booking" })
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
