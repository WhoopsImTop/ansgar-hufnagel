<template>
  <div class="gallery">
    <div class="gallery-lightbox" v-if="lightbox" @click="lightbox = false">
      <div class="gallery-lightbox__content">
        <div class="gallery-lightbox__content__image">
          <img :src="lightboxImage.image" :alt="lightboxImage.caption" />
        </div>
      </div>
    </div>
    <div
      class="gallery__container"
      v-for="(image, index) in gallery"
      :key="index"
      @click="(lightbox = true), (lightboxImage = image)"
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
  data() {
    return {
      lightbox: false,
      lightboxImage: null,
    };
  },
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

.gallery-lightbox {
  position: fixed;
  top: 70px;
  left: 0;
  width: 100%;
  height: calc(100vh - 70px);
  bottom: 0;
  right: 0;
  display: flex;
  background: #00000080;
  justify-content: center;
  align-items: center;
  z-index: 998;
}

.gallery-lightbox__content__image {
  width: auto;
  display: flex;
  align-items: center;
  justify-content: center;
}

.gallery-lightbox__content__image img {
  width: 100%;
  height: 80vh;
  max-height: 80vh;
  object-fit: cover;
}

@media (max-width: 900px) {
  .gallery {
    grid-template-columns: repeat(auto-fit, minmax(300px, 48%));
  }

  .gallery-lightbox__content__image img {
    width: 80vw;
    height: auto;
    object-fit: cover;
  }
}
</style>