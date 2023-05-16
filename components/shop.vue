<template>
  <div class="productGrid">
    <nuxt-link
      :to="'/produkte/' + product.id"
      class="product"
      v-for="(product, index) in products"
      :key="index"
      :id="product.id"
    >
      <div class="productImage">
        <img :src="product.image" alt="product image" />
      </div>
      <div class="productInfo">
        <h4>{{ product.title }}</h4>
        <div
          class="productDescription"
          v-html="productShortDescription(product)"
        ></div>
        <div class="price-container">
          <p class="price" :class="product.reduction ? 'discounted' : ''">{{ product.price.toFixed(2) }}€</p>
          <p v-if="product.reduction" class="reduction_price">{{ product.reduction.reduction_price.toFixed(2) }}€</p>
        </div>
      </div>
    </nuxt-link>
  </div>
</template>

<script>
export default {
  props: {
    products: {
      type: Array,
      required: true,
    },
  },
  methods: {
    productShortDescription(product) {
      return this.$md.render(product.description).substring(0, 300) + "...";
    },
  },
};
</script>

<style>
</style>