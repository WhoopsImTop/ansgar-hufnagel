<template>
    <div ref="map" class="map" style="width: 100%; height: 100%;"></div>
</template>

<script>
import maplibregl from "maplibre-gl";
import "maplibre-gl/dist/maplibre-gl.css";

export default {
  props: ["termine"],
  data() {
    return {
      map: null,
    };
  },
  computed: {
    markers() {
      if(this.termine.length == 0) return "";
      return this.termine.map((termin) => {
        let coordinates = JSON.parse(termin.location).coordinates;
        return {
          type: "Feature",
          geometry: {
            type: "Point",
            coordinates: [coordinates[0], coordinates[1]],
          },
          properties: {
            title: termin.location.name,
            description: termin.location.address,
          },
        };
      });
    },
  },
  mounted() {
    //calculate center of all markers
    let center = [13.38886, 52.517037];
    if(this.markers.length > 0) {
      let sumX = 0;
      let sumY = 0;
      this.markers.forEach((marker) => {
        sumX += marker.geometry.coordinates[0];
        sumY += marker.geometry.coordinates[1];
      });
      center = [sumX / this.markers.length, sumY / this.markers.length];
    }
    //calculate zoom level
    let zoom = 4;
    this.map = new maplibregl.Map({
      container: this.$refs.map,
      style:
        "https://api.maptiler.com/maps/streets-v2/style.json?key=tx0bWkeJlS2k9FWCMNgS",
      center: center,
      zoom: zoom,
    });

    //add markers to map
    if(this.markers.length > 0) this.addMarkers();

    //add hover eventlistner to .termin elements and fly to marker at data-coordinates
    let terminElements = document.querySelectorAll(".termin");
    terminElements.forEach((terminElement) => {
      terminElement.addEventListener("mouseenter", (e) => {
        let coordinates = e.target.dataset.coordinates.split(",");
        this.map.flyTo({
          center: {"lat": coordinates[1], "lng": coordinates[0]},
          zoom: 12,
        });
      });
    });
  },
  methods: {
    addMarkers() {
      //add marker to the map
      this.markers.forEach((marker) => {
        // make a marker for each feature and add to the map
        //add a custom marker icon
        let el = document.createElement("div");
        el.className = "marker";
        el.style.backgroundImage = "url(/marker.svg)";
        el.style.width = "50px";
        el.style.height = "50px";
        el.style.backgroundSize = "contain";
        el.style.backgroundRepeat = "no-repeat";
        el.style.backgroundPosition = "center";
        el.style.cursor = "pointer";
        new maplibregl.Marker(el)
          .setLngLat(marker.geometry.coordinates)
          .addTo(this.map);
      });
    },
  },
};
</script>

<style>
</style>