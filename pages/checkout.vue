<template>
  <div>
    <div class="content-container text-container checkout-page-grid">
      <div class="checkout-form">
        <h1>Kasse</h1>
        <form autocomplete="on">
          <!-- From should ask for name, last_name, email, phone, address, city, state, zip, country  -->
          <input type="text" placeholder="Vorname" name="name" v-model="name" />
          <input
            type="text"
            placeholder="Nachname"
            name="nachname"
            v-model="last_name"
          />
          <input
            type="email"
            placeholder="Email"
            name="email"
            v-model="email"
          />
          <input
            type="tel"
            placeholder="Telefon"
            name="phone"
            v-model="phone"
          />
          <input
            type="text"
            name="street"
            placeholder="Straße und Hausnummer"
            v-model="address"
          />
          <input type="text" placeholder="Stadt" name="city" v-model="city" />
          <input type="text" placeholder="PLZ" name="zip" v-model="zip" />
          <input
            type="text"
            placeholder="Bundesland"
            name="state"
            v-model="state"
          />
          <select placeholder="Land" name="land" v-model="country">
            <option
              v-for="country in defaultCountries"
              :key="country.code"
              :value="country.name"
            >
              {{ country.name }}
            </option>
          </select>
          <label
            ><input
              type="checkbox"
              v-model="datenschutz"
              style="margin-right: 10px"
            />Ich stimme den AGB's und der verarbeiterung meiner Daten gemäß der
            Datenschutzerklärung zu.</label
          >
        </form>
      </div>
      <div class="checkout-information">
        <div class="information-container">
          <div class="cartItems">
            <h2>Ihr Einkaufwagen</h2>
            <table>
              <tbody>
                <tr v-for="item in line_items" :key="item.id">
                  <td>{{ item.name }}</td>
                  <td>{{ item.quantity }} x</td>
                  <td>
                    {{
                      item.reduction
                        ? item.reduction.reduction_price.toFixed(2)
                        : item.price.toFixed(2)
                    }}€
                  </td>
                </tr>
                <tr>
                  <td>zzgl. Versandkosten</td>
                  <td></td>
                  <td>
                    <strong>{{ shippingCosts.toFixed(2) }}€</strong>
                  </td>
                </tr>
              </tbody>
            </table>
            <div class="total-price">
              <strong
                >Gesamt: {{ (totalPrice + shippingCosts).toFixed(2) }}€</strong
              >
            </div>
          </div>
          <div class="checkout-options">
            <h2>Zahlungsmethode</h2>
            <div class="payment-methods">
              <div class="payment-method">
                <input
                  type="radio"
                  id="paypal"
                  name="payment"
                  value="paypal"
                  v-model="paymentMethod"
                />
                <label for="paypal">PayPal</label>
              </div>
              <div class="payment-method">
                <input
                  type="radio"
                  id="ueberweisung"
                  name="payment"
                  value="ueberweisung"
                  v-model="paymentMethod"
                />
                <label for="ueberweisung">Überweisung</label>
              </div>
            </div>
            <div class="checkout-button">
              <button class="product-btn" @click="generateCheckout()">
                {{ loading ? "verarbeiten..." : "Kostenpflichtig Bestellen" }}
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  head() {
    return {
      title: "Ansgar Hufnagel | Kasse",
      meta: [
        {
          hid: "description",
          name: "description",
          content: "Kasse",
        },
      ],
    };
  },
  async asyncData({ $content, params }) {
    const produkte = await $content("produkte").fetch();
    return { produkte };
  },
  data: () => {
    return {
      name: "",
      last_name: "",
      email: "",
      phone: "",
      address: "",
      city: "",
      state: "",
      zip: "",
      country: "Bitte auswählen",
      datenschutz: false,
      defaultCountries: [
        { name: "Deutschland", code: "DE" },
        { name: "Österreich", code: "AT" },
        { name: "Schweiz", code: "CH" },
      ],
      line_items: [],
      totalPrice: 0,
      paymentMethod: null,
      loading: false,
      shippingCosts: 2.99,
    };
  },
  methods: {
    validateCheckout() {
      if (
        this.name &&
        this.last_name &&
        this.email &&
        this.phone &&
        this.address &&
        this.city &&
        this.state &&
        this.zip &&
        this.country &&
        this.datenschutz
      ) {
        return true;
      } else {
        return false;
      }
    },
    generateCheckout() {
      if (this.validateCheckout()) {
        this.loading = true;

        axios
          .post("https://ansgar-hufnagel.de/api/checkout", {
            name: this.name,
            last_name: this.last_name,
            email: this.email,
            phone: this.phone,
            street: this.address,
            city: this.city,
            state: this.state,
            zip: this.zip,
            country: this.country,
            lineItems: this.line_items,
            total: this.totalPrice,
            paymentMethod: this.paymentMethod,
          })
          .then((response) => {
            if (response.data.url) {
              localStorage.removeItem("cartItems");
              window.location.href = response.data.url;
            } else {
              window.alert(
                "Es ist ein Fehler aufgetreten. Bitte versuchen Sie es erneut."
              );
            }
            this.loading = false;
          })
          .catch((error) => {
            console.log(error);
            window.alert(
              "Es ist ein Fehler aufgetreten. Bitte versuchen Sie es erneut."
            );
            this.loading = false;
          });
      } else {
        alert("Bitte füllen Sie alle Felder aus.");
      }
    },
  },
  mounted() {
    let cartItems = JSON.parse(localStorage.getItem("cartItems"));
    if(!cartItems) {
      window.location.href = "/shop";
    }
    //get cartItems id and quantity and search id in products
    this.line_items = cartItems.map((item) => {
      let product = this.produkte.find((product) => product.id == item.id);
      this.totalPrice +=
        ((product.reduction
          ? product.reduction.reduction_price
          : product.price) * item.quantity) + this.shippingCosts;
      return {
        id: item.id,
        name: product.title,
        quantity: item.quantity,
        price: product.price,
        reduction: product.reduction,
      };
    });
  },
};
</script>

<style>
</style>