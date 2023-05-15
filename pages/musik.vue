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