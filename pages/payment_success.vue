<template>
  <div class="content-container text-container">
    <h1>Vielen Dank für ihre Bestellung!</h1>
    <p>Ich werde mich in kürze bei Ihnen Melden.</p>
  </div>
</template>

<script>
export default {
  head() {
    return {
      title: 'Ansgar Hufnagel | Bestellung erfolgreich',
      meta: [
        {
          hid: "description",
          name: "description",
          content: "Bestellung erfolgreich",
        },
        {
          hid: "og:title",
          property: "og:title",
          content: this.page.title,
        },
        {
          hid: "og:description",
          property: "og:description",
          content: this.page.description,
        },
        {
          hid: "og:image",
          property: "og:image",
          content: this.page.landing.landingImage,
        },
        {
          hid: "og:url",
          property: "og:url",
          content: "https://www.ansgar-hufnagel.de",
        },
        {
          hid: "og:type",
          property: "og:type",
          content: "website",
        },
        {
          hid: "og:locale",
          property: "og:locale",
          content: "de_DE",
        },
      ],
    };
  },
}
</script>

<style>

</style>