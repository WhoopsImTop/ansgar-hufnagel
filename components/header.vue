<template>
  <div class="sticky_nav">
    <div class="content-container nav_row">
      <div class="img-container">
        <NuxtLogo />
      </div>
      <div class="link-cintainer">
        <nuxt-link
          v-for="(link, index) in links"
          :key="index"
          :to="link.path"
          class="nuxt-link"
          >{{ link.name }}</nuxt-link
        >
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      links: [
        {
          name: "Moderation",
          path: "/",
        },
        {
          name: "Poetry Slam",
          path: "/poetry-slam",
        },
        {
          name: "Kabarett",
          path: "/kabarett",
        },
        {
          name: "Workshops",
          path: "/workshops",
        },
        {
          name: "Shop",
          path: "/shop",
        },
        {
          name: "Booking",
          path: "/booking",
        },
        {
          name: "Termine",
          path: "/termine",
        },
        {
          name: "Kontakt",
          path: "/kontakt",
        },
      ],
    };
  },
};
</script>

<style>
</style>