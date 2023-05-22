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
  head() {
    return {
      title: 'Ansgar Hufnagel | Shop',
      meta: [
        {
          hid: "description",
          name: "description",
          content: "Shop",
        },
        {
          hid: "og:title",
          property: "og:title",
          content: "Shop",
        },
        {
          hid: "og:description",
          property: "og:description",
          content: "Shop",
        },
        {
          hid: "og:image",
          property: "og:image",
          content: "/img/shop.jpg",
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
  components: { cartComponent },
  async asyncData({ $content }) {
    const products = await $content("produkte").fetch();
    return { products };
  },
};
</script>

<style>
</style>