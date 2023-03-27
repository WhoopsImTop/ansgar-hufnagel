<template>
    <div class="productGrid">
        <nuxt-link :to="'/produkte/' + product.id" class="product" v-for="(product, index) in products" :key="index" :id="product.id">
            <div class="productImage">
                <img :src="product.image" alt="product image">
            </div>
            <div class="productInfo">
                <h4>{{ product.title }}</h4>
                <div class="productDescription" v-html="productShortDescription(product)"></div>
                <p class="price">{{ product.price.toFixed(2) }}€</p>
            </div>
        </nuxt-link>
    </div>
</template>

<script>
export default {
    props: {
        products: {
            type: Array,
            required: true
        }
    },
    methods: {
        productShortDescription(product) {
            return this.$md.render(product.description).substring(0, 50) + '...';
        }
    }
}
</script>

<style>

</style>