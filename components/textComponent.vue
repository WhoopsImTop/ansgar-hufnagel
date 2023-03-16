<template>
  <div class="content-container text-container" :style="positionStyle">
    <h3>{{ title }}</h3>
    <p>{{ text }}</p>
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
        case "left":
          setPosition = "flex-start";
          break;
        case "right":
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