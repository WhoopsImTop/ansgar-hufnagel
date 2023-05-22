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
            Seien Sie immer auf dem neuesten Stand über Termine, Aktionen uvm.
          </p>
          <div id="mc_embed_signup">
            <form
              action="https://der-tausendsassa.us5.list-manage.com/subscribe/post?u=5556273accb27fdfdd313741f&id=4a73f60096&f_id=00840febf0"
              method="post"
              id="mc-embedded-subscribe-form"
              name="mc-embedded-subscribe-form"
              class="validate"
              target="_blank"
              novalidate
            >
              <div id="mc_embed_signup_scroll">
                <div
                  class="row"
                  style="
                    margin-top: 20px;
                    justify-content: unset;
                    align-items: baseline;
                  "
                >
                  <div
                    class="mc-field-group"
                    style="
                      width: 65%;
                      display: flex;
                      flex-direction: column;
                      margin-right: 10px;
                    "
                  >
                    <input
                      style="width: 100%"
                      type="email"
                      value=""
                      placeholder="E-Mail Adresse"
                      name="EMAIL"
                      class="required newsletter-input"
                      id="mce-EMAIL"
                      required
                    />

                    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                    <div
                      style="position: absolute; left: -5000px"
                      aria-hidden="true"
                    >
                      <input
                        type="text"
                        name="b_5556273accb27fdfdd313741f_4a73f60096"
                        tabindex="-1"
                        value=""
                      />
                    </div>
                  </div>
                  <input
                    type="submit"
                    value="Jetzt Abonnieren"
                    name="subscribe"
                    id="mc-embedded-subscribe"
                    class="primary-btn"
                  />
                </div>
              </div>
            </form>
          </div>
          <client-only>
            <script
              type="text/javascript"
              src="//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js"
            ></script>
            <!--End mc_embed_signup-->
          </client-only>
        </div>
        <div class="col booking">
          <h3>Booking</h3>
          <p style="margin-bottom: 10px">Kommen Sie mit mir ins Gespräch.</p>
          <p>
            <a
              style="text-decoration: none; color: #000000; font-size: 20px"
              href="tel:+49 151 19345725"
              >+49 151 19345725</a
            >
          </p>
          <p>
            <a
              style="
                text-decoration: none;
                color: #000000;
                font-size: 20px;
                margin-top: 20px;
              "
              href="mailto:mail@ansgarhufnagel.de"
              >mail@ansgarhufnagel.de</a
            >
          </p>
        </div>
      </div>
    </div>
    <div class="footer">
      <div class="content-container">
        <div class="row">
          <div class="col">
            <strong>Ansgar Hufnagel</strong>
            <div class="row">
              <div class="col" style="margin-top: 10px">
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
          <div class="col icon-row">
            <a href="https://www.youtube.com/@herrtausendsassa" target="_blank"
              ><img src="/youtube.svg" alt="youtube"
            /></a>
            <a href="https://www.facebook.com/Ansage.Hufnagel/" target="_blank"
              ><img src="/facebook.svg" alt="facebook"
            /></a>
            <a href="https://www.instagram.com/herrtausendsassa" target="_blank"
              ><img src="/instagram.svg" alt="instagram"
            /></a>
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