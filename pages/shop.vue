<template>
  <div>
    <loader title="Shop"></loader>
    <landing-image title="Shop" subtitle="Alles von Ansgar Hufnagel" />
    <div class="content-container">
      <shop :products="products"></shop>
    </div>
  </div>
</template>

<script>
export default {
  async asyncData({ $content }) {
    const products = await $content("produkte").fetch();
    return { products };
  },
};
</script>

<style>
</style>