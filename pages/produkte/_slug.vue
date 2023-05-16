<template>
  <div>
    <cart-component></cart-component>
    <div class="content-container text-container product-page-grid">
      <div class="img-container">
        <img :src="product[0].image" />
      </div>
      <div class="product-text-container">
        <h1>{{ product[0].title }}</h1>
        <div class="price-container">
          <p class="price" :class="product[0].reduction ? 'discounted' : ''">
            {{ product[0].price.toFixed(2) }}€
          </p>
          <p v-if="product[0].reduction" class="reduction_price">
            {{ product[0].reduction.reduction_price.toFixed(2) }}€
          </p>
        </div>
        <button
          class="product-btn"
          @click="addToCart(product[0])"
          :disabled="this.loading"
        >
          {{ this.loading ? "wird hinzugefügt" : "in den Warenkorb" }}
        </button>
        <p
          class="product-description"
          v-html="$md.render(product[0].description)"
        ></p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: () => {
    return {
      loading: false,
    };
  },
  async asyncData({ $content, params }) {
    const product = await $content("produkte")
      .where({ id: params.slug })
      .fetch();
    return { product };
  },
  methods: {
    addToCart(product) {
      this.loading = true;
      product.quantity = 1;
      this.$store.commit("setCartItems", product);
      setTimeout(() => {
        this.loading = false;
      }, 1000);
    },
  },
};
</script>

<style>
</style>