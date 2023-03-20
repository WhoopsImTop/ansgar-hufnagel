<template>
  <div>
    <div class="loader">
      <div class="content-container">
        <div class="text-container">
          <h1>Ansgar Hufnagel</h1>
        </div>
      </div>
    </div>
    <Header />
    <Nuxt />
    <Footer />
  </div>
</template>

<script>
export default {
  name: 'main',
  created () {
    setTimeout(() => {
      document.querySelector('.loader').style.opacity = 0;
    }, 1000)
    setTimeout(() => {
      document.querySelector('.loader').style.display = 'none';
    }, 1200)
  }
}
</script>

<style>

</style>