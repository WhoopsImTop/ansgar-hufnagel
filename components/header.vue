<template>
  <div class="sticky_nav">
    <div class="content-container nav_row">
      <div class="img-container">
        <logo style="rotate: 0deg; height: 100px;"/>
        <nuxt-link to="/" class="nuxt-link main-link" style="text-transform: uppercase; font-weight: 800; font-style: italic;">Ansgar Hufnagel</nuxt-link>
      </div>
      <div class="link-container" @click="toggleMobileNav">
        <nuxt-link
          @click="toggleMobileNav"
          v-for="(link, index) in links"
          :key="index"
          :to="link.path"
          class="nuxt-link"
          >{{ link.name }}</nuxt-link
        >
      </div>
      <div class="mobile-cross" @click="toggleMobileNav">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
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
          path: "/moderation",
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
          name: "Termine",
          path: "/termine",
        },
        {
          name: "Shop",
          path: "/shop",
        },
        {
          name: "Booking",
          path: "/booking",
        },
      ],
    };
  },
  methods: {
    toggleMobileNav() {
      const nav = document.querySelector(".link-container");
      const burger = document.querySelector(".mobile-cross");
      nav.classList.toggle("active");
      burger.classList.toggle("active");
    },
  },
};
</script>

<style>
</style>