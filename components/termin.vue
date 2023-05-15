<template>
  <div class="grid-2">
    <div class="terminliste">
      <termin-item
        v-for="(termin, index) in termineToDisplay"
        :key="index"
        :termin="termin"
      ></termin-item>
    </div>
    <div class="map-container">
      <map-component :termine="termineToDisplay"></map-component>
    </div>
  </div>
</template>

<script>
import terminItem from "./terminItem.vue";
export default {
  components: { terminItem },
  props: ["termine", "termineLimit"],
  computed: {
    termineToDisplay() {
      return this.termine.slice(0, this.termineLimit);
    },
  },
};
</script>

<style>
</style>