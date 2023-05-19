<template>
  <div :style="positionStyle">
      <h3 v-if="title" 
        :class="image ? 'w-50' : ''">{{ title }}</h3>
      <p
        v-if="text"
        :class="image ? 'w-50' : ''"
        :style="position == 'mitte' ? 'text-align: center' : ''"
        v-html="$md.render(text)"
      ></p>
      <div class="image">
        <img v-if="image" :src="image" :alt="title" />
      </div>
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
    image: {
      type: String,
      default: null,
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