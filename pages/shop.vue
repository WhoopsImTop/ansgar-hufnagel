<template>
  <div>
    <loader title="Shop"></loader>
    <landing-image title="Shop" subtitle="Alles von Ansgar Hufnagel" :backgroundImage="'/img/shop.jpg'" />
    <cart-component></cart-component>
    <div class="content-container shop-items">
      <h2 style="margin-bottom: 30px">Alle Produkte</h2>
      <shop :products="products"></shop>
    </div>
  </div>
</template>

<script>
import cartComponent from '~/components/cartComponent.vue';
export default {
  components: { cartComponent },
  async asyncData({ $content }) {
    const products = await $content("produkte").fetch();
    return { products };
  },
};
</script>

<style>
</style>