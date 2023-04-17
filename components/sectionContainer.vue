<template>
  <div :class="classesToAppend">
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
    image: {
      type: String,
      default: null,
    },
    highlighted: {
      type: Boolean,
      default: false,
    },
  },
  computed: {
    classesToAppend() {
      let classes = "";
      if (this.highlighted) {
        classes += "highlighted ";
      }
      if (this.image) {
        classes += "content-row ";
      }
      return classes;
    },
  }
};
</script>

<style>
</style>