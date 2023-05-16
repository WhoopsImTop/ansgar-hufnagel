<template>
  <div>
    <div class="card-container" v-show="showCart">
      <div class="closeBtn" @click="showCart = false">X</div>
      <div class="product-list">
        <div class="list-item" v-for="product in cartItems" :key="product.id">
          <img width="70px" :src="product.image" :alt="product.title" />
          <div class="cart-item-information">
            <h5>{{ product.title }} | {{ product.reduction ? product.reduction.reduction_price : product.price.toFixed(2) }}€</h5>
            <p>{{ product.quantity }} mal im Warenkorb</p>
            <div class="quantity-options">
              <button
                class="quantity-btn"
                @click="decreaseQuantity(product)"
                :disabled="product.quantity === 1"
              >
                —
              </button>
              <button class="quantity-btn" @click="increaseQuantity(product)">
                +
              </button>
            </div>
          </div>
          <div class="cart-item-actions">
            <button class="remove-btn" @click="removeItem(product)">x</button>
          </div>
        </div>
      </div>
      <button class="checkout-btn" @click="checkout">Zur Kasse</button>
    </div>
    <div class="cartIcon" @click="showCart = !showCart">
      <span class="item-info">{{ cartItems.length }}</span>
      <img src="/cart.svg" alt="Warenkorb" />
    </div>
  </div>
</template>

<script>
export default {
  data: () => {
    return {
      cartItems: [],
      showCart: false,
    };
  },
  methods: {
    increaseQuantity(product) {
      let cartItems = JSON.parse(localStorage.getItem("cartItems")) || [];
      cartItems.forEach((cartItem) => {
        if (cartItem.id === product.id) {
          cartItem.quantity++;
        }
      });
      localStorage.setItem("cartItems", JSON.stringify(cartItems));
      this.$store.commit("loadCardItems", cartItems);
      this.cartItems = cartItems;
    },
    decreaseQuantity(product) {
      let cartItems = JSON.parse(localStorage.getItem("cartItems")) || [];
      cartItems.forEach((cartItem) => {
        if (cartItem.id === product.id) {
          cartItem.quantity--;
        }
      });
      localStorage.setItem("cartItems", JSON.stringify(cartItems));
      this.$store.commit("loadCardItems", cartItems);
      this.cartItems = cartItems;
    },
    removeItem(product) {
      let cartItems = JSON.parse(localStorage.getItem("cartItems")) || [];
      cartItems = cartItems.filter((cartItem) => cartItem.id !== product.id);
      localStorage.setItem("cartItems", JSON.stringify(cartItems));
      this.$store.commit("loadCardItems", cartItems);
      this.cartItems = cartItems;
    },
    checkout() {
      this.$router.push("/checkout");
    },
  },
  mounted() {
    this.cartItems = JSON.parse(localStorage.getItem("cartItems")) || [];
    this.$store.commit("loadCardItems", this.cartItems);
  },
};
</script>

<style>
</style>