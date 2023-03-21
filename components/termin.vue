<template>
  <div class="grid-2">
    <div class="terminliste">
      <termin-item
        v-for="(termin, index) in termine"
        :key="index"
        :termin="termin"
      ></termin-item>
    </div>
    <div class="map"></div>
  </div>
</template>

<script>
import terminItem from "./terminItem.vue";
export default {
  components: { terminItem },
  props: ["termine"],
};
</script>

<style>
</style>