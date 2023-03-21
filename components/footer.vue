<template>
  <div class="footer-content">
    <div class="highlighted">
      <div
        class="content-container text-container row"
        style="justify-content: unset"
      >
        <div class="col newsletter">
          <h3>Newsletter Abonnieren</h3>
          <p>
            Seien Sie immer auf dem Neusten stand über Termine, Aktionen uvm.
          </p>
          <div class="row" style="margin-top: 20px; justify-content: unset">
            <input
              class="newsletter-input"
              type="text"
              placeholder="E-Mail Adresse"
            />
            <button class="primary-btn">Jetzt Abonnieren</button>
          </div>
        </div>
        <div class="col booking">
          <h3>Booking</h3>
          <p style="margin-bottom: 10px">Kommen Sie mit mir ins Gespräch.</p>

          <a
            style="text-decoration: none; color: #000000; font-size: 20px"
            href="tel:+49 151 19345725"
            >+49 151 19345725</a
          >
          <br />
          <a
            style="text-decoration: none; color: #000000; font-size: 20px"
            href="mailto:mail@ansgarhufnagel.de"
            >mail@ansgarhufnagel.de</a
          >
        </div>
      </div>
    </div>
    <div class="footer">
      <div class="content-container">
        <div class="row">
          <div class="col">
            <h4>Ansgar Hufnagel</h4>
            <div class="row">
              <div class="col">
                <p>Valentinstraße 7</p>
                <p>79100 Freiburg</p>
              </div>
              <div class="col contact">
                <p>+49 151 19345725</p>
                <p>mail@ansgarhufnagel.de</p>
              </div>
            </div>
          </div>
          <div class="col">
            <p>
              <nuxt-link to="/impressum">Impressum</nuxt-link>
              <nuxt-link to="/datenschutzerklaerung"
                >Datenschutzerklaerung</nuxt-link
              >
            </p>
          </div>
          <div class="col">
            <img src="youtube.svg" alt="youtube" />
            <img src="facebook.svg" alt="facebook" />
            <img src="instagram.svg" alt="instagram" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style>
</style>