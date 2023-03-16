<template>
  <div>
    <landingImage
      :backgroundImage="'moderation.png'"
      title="Ansgar Hufnagel"
      subtitle="Moderation. Kleinkunst. Kabarett. Workshops."
    ></landingImage>
    <textComponent
      title="Über mich"
      text="asdf"
      position="center"
    ></textComponent>
    <sectionContainer title="Moderation" :highlighted="true">
      <template v-slot:content>
        <div class="card-grid">
          <card
            v-for="card in cards"
            :key="card.title"
            :cardTitle="card.cardText"
            :cardImage="card.cardImage"
            :cardText="card.cardText"
            :cardActionBtnText="card.cardActionBtnText"
            :cardActionBtnLink="card.cardActionBtnLink"
          ></card>
        </div>
      </template>
    </sectionContainer>
    <sectionContainer title="Kundenmeinungen" :highlighted="false">
      <template v-slot:content>
        <quoteSlider></quoteSlider>
      </template>
    </sectionContainer>
  </div>
</template>

<script>
export default {
  name: "IndexPage",
  layout: "main",
  data() {
    return {
      cards: [
        {
          cardImage: "moderation.png",
          cardTitle: "Moderation",
          cardText: "asdf",
        },
        {
          cardImage: "moderation.png",
          cardTitle: "Moderation",
          cardText: "asdf",
          cardActionBtnText: "asdf",
          cardActionBtnLink: "/",
        },
        {
          cardImage: "moderation.png",
          cardTitle: "Moderation",
          cardText: "asdf",
        },
      ],
    };
  },
};
</script>
