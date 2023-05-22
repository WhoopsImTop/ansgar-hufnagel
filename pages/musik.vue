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
    <div class="content-container text-container floating">
      <h3>Spotify</h3>
      <iframe
        style="border-radius: 12px"
        src="https://open.spotify.com/embed/artist/4uVgLanzASZrrBo7DDJEXH?utm_source=generator"
        width="100%"
        height="352"
        frameBorder="0"
        allowfullscreen=""
        allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
        loading="lazy"
      ></iframe>
    </div>
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
  components: { componentRenderer },
  name: "IndexPage",
  layout: "default",
  async asyncData({ $content }) {
    const page = await $content("seiten", "musik").fetch();
    return { page };
  },
  data() {
    return {};
  },
};
</script>

<style scoped>
</style>