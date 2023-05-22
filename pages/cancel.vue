<template>
  <div class="content-container text-container">
    <h1>Der Bestellvorgang wurde von Ihnen abgebrochen.</h1>
    <p>Sie können es gerne später nocheinmal versuchen.</p>
    <br>
    <nuxt-link class="link" to="/shop">zum Shop</nuxt-link>
  </div>
</template>

<script>
export default {};
</script>

<style>
.link {
  text-decoration: none;
  color: var(--dark-text);
  align-self: center;
  padding: 8px 10px 5px 30px;
  position: relative;
  background-color: var(--primary-color);
}

.link::before {
  content: ' ';
  position: absolute;
  left: 5px;
  bottom: 5px;
  background-image: url('./static/link.svg');
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
  width: 20px;
  height: 20px;
}
</style>