<template>
  <div class="termin" :data-coordinates="markerCoordinates">
    <div class="calendar-symbol">
      <div class="calendar-symbol__day">{{ day }}</div>
      <div class="calendar-symbol__month">{{ month }}</div>
    </div>
    <div class="text-content">
      <h4>{{ termin.title }}</h4>
      <p
        :style="
          termin.alternativeDate.show ? 'text-decoration: line-through' : ''
        "
      >
        {{ termin.ort }}, {{ date }} {{ time }} Uhr
      </p>
      <p v-if="termin.alternativeDate.show">
        {{ termin.alternativeDate.location }}, {{ ersatzDate }}
        {{ ersatzTime }} Uhr
      </p>
      <div style="margin-top: 10px">
        <nuxt-link
          v-if="termin.zusatz"
          :to="'termine/' + termin.slug"
          class="link"
          >Mehr erfahren</nuxt-link
        >
        <a
          v-if="termin.link || termin.linktext"
          class="link"
          target="_blank"
          :href="termin.link"
          >{{ termin.linktext ? termin.linktext : termin.link }}</a
        >
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["termin"],
  computed: {
    markerCoordinates() {
      let coordinates = JSON.parse(this.termin.location).coordinates;
      return [coordinates[0], coordinates[1]];
    },
    date() {
      return new Date(this.termin.date).toLocaleDateString("de-DE");
    },
    month() {
      return new Date(this.termin.date).toLocaleDateString("de-DE", {
        month: "short",
      });
    },
    day() {
      return new Date(this.termin.date).toLocaleDateString("de-DE", {
        day: "numeric",
      });
    },
    time() {
      let time = new Date(this.termin.date).toLocaleTimeString("de-DE");
      //remove seconds
      time = time.slice(0, -3);
      return time;
    },
    ersatzDate() {
      return new Date(
        this.termin.alternativeDate.alternativeDate
      ).toLocaleDateString("de-DE");
    },
    ersatzTime() {
      let time = new Date(
        this.termin.alternativeDate.alternativeDate
      ).toLocaleTimeString("de-DE");
      //remove seconds
      time = time.slice(0, -3);
      return time;
    },
  },
};
</script>

<style>
</style>