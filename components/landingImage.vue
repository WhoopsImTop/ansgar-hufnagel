<template>
  <div
    class="landing-image"
    :style="'background-image: url(' + backgroundImage + ')'"
  >
    <div class="content-container">
      <div class="landing-text-container">
        <h1>{{ title }}</h1>
        <h2>{{ subtitle }}</h2>
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