<template>
  <div>
    <loader :title="page.title"></loader>
    <div class="content-container text-container wichtig">
      <nuxt-content :document="page"></nuxt-content>
    </div>
  </div>
</template>
  
<script>
import componentRenderer from "~/components/componentRenderer.vue";
export default {
  components: { componentRenderer },
  name: "IndexPage",
  layout: "default",
  async asyncData({ $content, params }) {
    const page = await $content("wichtig/" + params.slug).fetch();
    return { page };
  },
};
</script>
  
<style>
.wichtig h3 {
    margin-top: 30px;
}
</style>