<template>
  <div :style="positionStyle">
    <h3 v-if="title">{{ title }}</h3>
    <p v-if="text">{{ text }}</p>
  </div>
</template>

<script>
export default {
  props: {
    title: {
      type: String,
    },
    text: {
      type: String,
    },
    position: {
      type: String,
    },
  },
  computed: {
    positionStyle() {
      let setPosition;
      switch (this.position) {
        case "links":
          setPosition = "flex-start";
          break;
        case "rechts":
          setPosition = "flex-end";
          break;
        default:
          setPosition = "center";
          break;
      }
      return `display: flex; flex-direction: column; align-items: ${setPosition}`;
    },
  },
};
</script>

<style>
</style>