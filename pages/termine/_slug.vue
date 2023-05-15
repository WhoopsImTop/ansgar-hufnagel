<template>
  <div class="content-container text-container">
    <h3>{{ termin.title }}</h3>
    <div v-if="termin.link" class="link-container" style="margin: 10px 0 20px;">
      <a :href="termin.link" class="termin-link" target="_blank">{{ termin.linktext ? termin.linktext : termin.link }}</a>
    </div>
    <p v-html="$md.render(termin.zusatz)"></p>
    <map-component style="min-height: 300px; margin-top: 50px" :termine="[termin]"></map-component>
  </div>
</template>

<script>
export default {
    async asyncData({ $content, params }) {
        const termin = await $content("termine", params.slug).fetch();
        return { termin };
    },
}
</script>

<style>

</style>