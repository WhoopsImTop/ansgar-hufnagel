<template>
  <div class="loader">
    <div class="content-container">
      <div class="text-container">
        <logo class="loader-logo"></logo>
        <h1>{{ title }}</h1>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["title"],
  created() {
    setTimeout(() => {
      document.querySelector(".loader").style.display = "none";
    }, 1200);
  },
};
</script> 

<style>
</style>