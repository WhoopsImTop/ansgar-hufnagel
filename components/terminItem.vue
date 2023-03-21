<template>
  <div class="termin">
    <div class="text-content">
      <h3>{{ termin.title }}</h3>
      <h4>{{ termin.ort }}, {{ new Date(termin.date).toLocaleDateString('de-DE') }} {{ termin.startTime }}</h4>
    </div>
    <a class="link" :href="termin.link">{{ termin.linktext }}</a>
  </div>
</template>

<script>
export default {
  props: [
    "termin"
  ],
};
</script>

<style>
</style>