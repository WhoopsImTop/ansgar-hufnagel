export const state = () => ({
  cartItems: [],
});

export const getters = {
  cartItems: (state) => state.cartItems,
};

export const mutations = {
  loadCardItems(state, cartItems) {
    state.cartItems = cartItems;
  },
  setCartItems(state, cartItems) {
    //handle quantity if item already exists
    const existingItem = state.cartItems.find(
        (item) => item.id === cartItems.id
    );
    if (existingItem) {
        existingItem.quantity++;
    } else {
        state.cartItems.push(cartItems);
    }
    localStorage.setItem("cartItems", JSON.stringify(state.cartItems));
  },
  removeCartItem(state, cartItem) {
    state.cartItems.splice(cartItem, 1);
  },
  updateQuantity(state, cartItem) {
    state.cartItems[cartItem].quantity = quantity;
  },
};
