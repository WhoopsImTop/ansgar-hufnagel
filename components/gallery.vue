<template>
  <div class="gallery">
    <div
      class="gallery__container"
      v-for="(image, index) in gallery"
      :key="index"
    >
      <div class="gallery__container__image">
        <img :src="image.image" :alt="image.caption" />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["gallery"],
};
</script>

<style>
.gallery {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 32%));
  grid-gap: 10px;
}

.gallery__container {
  width: 100%;
  height: 100%;
  max-height: 300px;
  object-fit: cover;
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
}

.gallery__container__image {
    height: 100%;
}

.gallery__container__image img {
  height: 100%;
  width: auto;
  object-fit: cover;
}
</style>