<template>
  <div class="content-container text-container product-page-grid">
    <div class="img-container">
      <img :src="product[0].image" />
    </div>
    <div class="product-text-container">
      <h1>{{ product[0].title }}</h1>
      <p class="price">{{ product[0].price.toFixed(2) }}€</p>
      <button class="product-btn">Kaufen</button>
      <p class="product-description" v-html="$md.render(product[0].description)"></p>
    </div>
  </div>
</template>

<script>
export default {
  async asyncData({ $content, params }) {
    const product = await $content("produkte")
      .where({ id: params.slug })
      .fetch();
    return { product };
  },
};
</script>

<style>
</style>