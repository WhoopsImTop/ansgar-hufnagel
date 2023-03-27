<template>
  <div
    class="landing-image"
    :style="'background-image: url(' + backgroundImage + ')'"
  >
    <div class="content-container landing-content-container">
      <div class="landing-text-container">
        <h1 :style="!backgroundImage ? 'color: #000000' : ''">{{ title }}</h1>
        <h2 :style="!backgroundImage ? 'color: #000000' : ''">{{ subtitle }}</h2>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    backgroundImage: {
      type: String,
    },
    title: {
      type: String,
    },
    subtitle: {
      type: String,
    },
  },
};
</script>

<style>
</style>