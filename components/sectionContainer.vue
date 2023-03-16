<template>
  <div :class="highlighted ? 'highlighted' : ''">
    <div class="content-container text-container">
      <h3>{{ title }}</h3>
      <slot name="content"></slot>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    title: {
      type: String,
    },
    highlighted: {
      type: Boolean,
      default: false,
    },
  },
};
</script>

<style>
</style>