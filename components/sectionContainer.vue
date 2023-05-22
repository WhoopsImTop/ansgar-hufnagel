<template>
  <div :class="classesToAppend">
    <div class="content-container text-container" :style="noPadding ? 'padding-top: 0px;' : ''">
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
    noPadding: {
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