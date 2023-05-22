<template>
  <div class="content-container text-container">
    <h3>Newsletteranmeldung</h3>
    <div id="mc_embed_signup">
      <form
        action="https://der-tausendsassa.us5.list-manage.com/subscribe/post?u=5556273accb27fdfdd313741f&amp;id=4a73f60096&amp;f_id=00840febf0"
        method="post"
        id="mc-embedded-subscribe-form"
        name="mc-embedded-subscribe-form"
        class="validate"
        target="_blank"
        novalidate
      >
        <div id="mc_embed_signup_scroll">
          <div class="indicates-required">
            <span class="asterisk">*</span> Pflichtfelder
          </div>
          <div class="mc-field-group">
            <label for="mce-FNAME">Vorname </label>
            <input type="text" value="" name="FNAME" class="" id="mce-FNAME" />
            <span id="mce-FNAME-HELPERTEXT" class="helper_text"></span>
          </div>
          <div class="mc-field-group">
            <label for="mce-LNAME">Nachname </label>
            <input type="text" value="" name="LNAME" class="" id="mce-LNAME" />
            <span id="mce-LNAME-HELPERTEXT" class="helper_text"></span>
          </div>
          <div class="mc-field-group">
            <label for="mce-EMAIL"
              >E-Mail-Adresse <span class="asterisk">*</span>
            </label>
            <input
              type="email"
              value=""
              name="EMAIL"
              class="required email"
              id="mce-EMAIL"
              required
            />
            <span id="mce-EMAIL-HELPERTEXT" class="helper_text"></span>
          </div>
          <div id="mce-responses" class="clear foot">
            <div
              class="response"
              id="mce-error-response"
              style="display: none"
            ></div>
            <div
              class="response"
              id="mce-success-response"
              style="display: none"
            ></div>
          </div>
          <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
          <div style="position: absolute; left: -5000px" aria-hidden="true">
            <input
              type="text"
              name="b_5556273accb27fdfdd313741f_4a73f60096"
              tabindex="-1"
              value=""
            />
          </div>
          <div class="optionalParent">
            <div class="clear foot">
              <input
                type="submit"
                value="Anmelden"
                name="subscribe"
                id="mc-embedded-subscribe"
                class="button"
              />
              <p class="brandingLogo">
                <a
                  href="http://eepurl.com/hMM1Sr"
                  title="Mailchimp - email marketing made easy and fun"
                  ><img
                    src="https://eep.io/mc-cdn-images/template_images/branding_logo_text_dark_dtp.svg"
                /></a>
              </p>
            </div>
          </div>
        </div>
      </form>
    </div>
    <script
      type="text/javascript"
      src="//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js"
    ></script>
    <script type="text/javascript">
      (function ($) {
        window.fnames = new Array();
        window.ftypes = new Array();
        fnames[0] = "EMAIL";
        ftypes[0] = "email";
        fnames[1] = "FNAME";
        ftypes[1] = "text";
        fnames[2] = "LNAME";
        ftypes[2] = "text";
        /*
         * Translated default messages for the $ validation plugin.
         * Locale: DE
         */
        $.extend($.validator.messages, {
          required: "Dieses Feld ist ein Pflichtfeld.",
          maxlength: $.validator.format(
            "Geben Sie bitte maximal {0} Zeichen ein."
          ),
          minlength: $.validator.format(
            "Geben Sie bitte mindestens {0} Zeichen ein."
          ),
          rangelength: $.validator.format(
            "Geben Sie bitte mindestens {0} und maximal {1} Zeichen ein."
          ),
          email: "Geben Sie bitte eine gültige E-Mail Adresse ein.",
          url: "Geben Sie bitte eine gültige URL ein.",
          date: "Bitte geben Sie ein gültiges Datum ein.",
          number: "Geben Sie bitte eine Nummer ein.",
          digits: "Geben Sie bitte nur Ziffern ein.",
          equalTo: "Bitte denselben Wert wiederholen.",
          range: $.validator.format(
            "Geben Sie bitten einen Wert zwischen {0} und {1}."
          ),
          max: $.validator.format(
            "Geben Sie bitte einen Wert kleiner oder gleich {0} ein."
          ),
          min: $.validator.format(
            "Geben Sie bitte einen Wert größer oder gleich {0} ein."
          ),
          creditcard: "Geben Sie bitte ein gültige Kreditkarten-Nummer ein.",
        });
      })(jQuery);
      var $mcj = jQuery.noConflict(true);
    </script>
    <!--End mc_embed_signup-->
  </div>
</template>

<script>
export default {};
</script>

<style>
.mc-field-group {
    display: flex;
    flex-direction: column;
    margin: 20px 0;
}

.mc-field-group label {
    margin-bottom: 5px;
}

.mc-field-group input {
    padding: 10px 15px;
    border: 1px solid #ccc;
}

.mc-field-group input:focus {
    outline: none;
    border: 1px solid #000;
}

#mc-embedded-subscribe {
    background-color: #000;
    color: #fff;
    border: none;
    padding: 10px 15px;
    font-size: 16px;
    cursor: pointer;
}

.clear.foot {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
</style>