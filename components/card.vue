<template>
  <div class="card">
    <div v-if="cardImage" class="card-image">
      <img :src="cardImage" :alt="cardTitle" />
    </div>
    <div class="card-content">
      <h3 v-if="cardTitle">{{ cardTitle }}</h3>
      <p v-if="cardText">{{ cardText }}</p>
    </div>
    <div class="card-actions" v-if="cardActionBtnText && cardActionBtnLink">
      <nuxt-link :to="cardActionBtnText" class="card-action-btn">{{
        cardActionBtnLink
      }}</nuxt-link>
    </div>
  </div>
</template>

<script>
export default {
    props: {
        cardImage: {
        type: String,
        },
        cardTitle: {
        type: String,
        },
        cardText: {
        type: String,
        },
        cardActionBtnText: {
        type: String,
        },
        cardActionBtnLink: {
        type: String,
        },
    },
};
</script>

<style>
</style>