<template>
  <div>
    <sectionContainer
      :highlighted="component.highlight"
      :image="component.image"
    >
      <template v-slot:content>
        <textComponent
          :title="component.title"
          :text="component.body"
          :position="component.position"
          :image="component.image"
        ></textComponent>
        <div class="card-grid" v-if="component.cards">
          <card
            v-for="card in component.cards"
            :key="card.title"
            :cardTitle="card.title"
            :cardImage="card.image"
            :cardText="card.body"
            :cardActionBtnText="card.link"
            :cardActionBtnLink="card.linktext"
          ></card>
        </div>
        <quote-slider
          v-if="component.kundenmeinungen"
          :quoteCategory="component.kundenmeinungen"
        ></quote-slider>
        <termin
          style="margin-top: 30px"
          v-if="component.termine"
          :termine="termine"
        ></termin>
        <gallery
          v-if="component.gallery"
          :gallery="component.gallery"
        ></gallery>
        <media v-if="component.videos" :videos="component.videos"></media>
        <downloads v-if="component.downloads" :downloads="component.downloads"></downloads>
      </template>
    </sectionContainer>
  </div>
</template>

<script>
export default {
  props: ["component", "termine"],
};
</script>

<style>
</style>