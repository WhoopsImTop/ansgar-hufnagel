<template>
  <div>
    <sectionContainer :highlighted="component.highlight">
      <template v-slot:content>
      <textComponent
        :title="component.title"
        :text="component.body"
        :position="component.position"
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
        <quote-slider v-if="component.kundenmeinungen" :testimonials="testimonials"></quote-slider>
        <termin v-if="component.termine" :termine="termine"></termin>
      </template>
    </sectionContainer>
  </div>
</template>

<script>
export default {
  props: ["component", "testimonials", "termine"],
};
</script>

<style>
</style>