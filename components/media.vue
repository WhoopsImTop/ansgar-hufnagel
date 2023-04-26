<template>
  <div class="video-container">
    <div class="video__container" v-for="(video, index) in videos" :key="index">
      <iframe
        width="100%"
        :src="video.video"
        frameborder="0"
        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
        allowfullscreen
      ></iframe>
    </div>
  </div>
</template>

<script>
export default {
  props: ["videos"],
};
</script>

<style>
.video-container {
  display: grid;
  grid-template-columns: repeat(auto-fit, 100%);
  grid-gap: 10px;
}

.video__container {
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
  overflow: hidden;
  width: 100%;
  padding-top: 56.25%;
}

.video__container > iframe {
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  width: 100%;
  height: 100%;
}
</style>