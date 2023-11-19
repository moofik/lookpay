<template>
  <main class="main-register">
    <form v-if="step==1" class="main-exchange-form" @submit.prevent="pay">
      <div class="fields_container">
        <div class="from_cur_container" :class="{logged_in: this.authenticated}">
          <legend class="cur_legend">Вы отдаете</legend>
          <div class="form_radio_btn">
            <input id="currency_from_1" type="radio" name="currency_from" value="RUB" checked v-model="cur_from">
            <label for="currency_from_1">RUB</label>
          </div>
          <div class="form_radio_btn">
            <input id="currency_from_2" type="radio" name="currency_from" value="USD" v-model="cur_from">
            <label for="currency_from_2">USD</label>
          </div>
        </div>
        <div class="to_cur_container" :class="{logged_in: this.authenticated}">
          <legend class="cur_legend">Вы получаете</legend>
          <div class="form_radio_btn">
            <input id="currency_from_3" type="radio" name="currency_to" value="BTC" v-model="cur_to" checked>
            <label for="currency_from_3">BTC</label>
          </div>
          <div class="form_radio_btn">
            <input id="currency_from_4" type="radio" name="currency_to" value="ETH" v-model="cur_to">
            <label for="currency_from_4">ETH</label>
          </div>
          <div class="form_radio_btn">
            <input id="currency_from_5" type="radio" name="currency_to" value="USDT" v-model="cur_to">
            <label for="currency_from_5">USDT</label>
          </div>
        </div>
        <div class="amts_container" :class="{logged_in: this.authenticated}">
          <div class="rate__container">
            <div class="rate__inside_container">
              <label for="amt">Сумма</label>
              <input id="amt" required class="exchange-text-input" type="number" placeholder=""
                     v-model.trim="requested_amt"/>
              <label for="rate">Стоимость</label>
              <input ref="rate_ref" id="rate" required class="exchange-text-input" type="text" placeholder=""
                     v-model="calculated_amt" disabled/>
            </div>
          </div>
        </div>
        <div class="login_pass_container" v-if="!this.authenticated">
          <label for="email">Email</label>
          <input id="email" required class="exchange-text-input" type="email" placeholder="me@mail.ru"
                 v-model.trim="user.email"/>
          <label for="password">Пароль</label>
          <input id="password" required class="exchange-text-input" type="text" placeholder="Пароль"
                 v-model.trim="user.password"/>
        </div>
      </div>
      <div class="button_container">
        <button class="pay_button glow">Обменять</button>
      </div>
    </form>
    <div v-if="step==2" class="main-exchange-form">
      <div class="successful_payment">
        Обмен был зарегестрирован. Ваш ID платежа: {{ payment_id }} <br/>
        Статус платежа вы можете отследить в личном кабинете.
      </div>
      <div class="button_container">
        <button class="pay_button glow" @click="newExchange">Новый обмен</button>
      </div>
    </div>
  </main>
</template>
<script>
import {mapActions} from 'vuex'

function debounce(fn, wait) {
  let timer;
  return function (...args) {
    if (timer) {
      clearTimeout(timer); // clear any pre-existing timer
    }
    const context = this; // get the current context
    timer = setTimeout(() => {
      fn.apply(context, args); // call the function if time expires
    }, wait);
  }
}

let controller = new AbortController();

export default {
  name: 'exchange',
  data() {
    return {
      step: 1,
      user: {
        email: "",
        password: ""
      },
      cur_from: "RUB",
      cur_to: "BTC",
      calculated_amt: 0,
      calculating_amt: false,
      requested_amt: 0,
      validationErrors: {},
      processing: false,
      ongoingRequest: false,
      payment_id: null
    }
  },
  methods: {
    ...mapActions({
      signIn: 'auth/loginWithoutRedirect',
      signOut: "auth/logout"
    }),
    async newExchange() {
      this.step = 1;
      this.cur_from = "RUB";
      this.cur_to = "BTC";
      this.calculated_amt = 0;
      this.calculating_amt = false;
      this.requested_amt = 0;
      this.validationErrors = {};
      this.processing = false;
      this.ongoingRequest = false;
      this.payment_id = null;
    },
    async login() {
      this.processing = true
      await axios.get('/sanctum/csrf-cookie')
      await axios.post('/api/login', this.user).then(({data}) => {
        this.validationErrors = {}
        this.signIn(data)
      }).catch(({data}) => {
        if (data.status === 422) {
          this.validationErrors = data.data.errors
        } else {
          this.validationErrors = {}
          alert(data.data.message)
        }
      }).finally(() => {
        this.processing = false
      })
    },

    async logout() {
      await axios.post('/api/logout').then(({data}) => {
        this.signOut()
        //this.toAuthorizedPayment()
      })
    },

    toAuthorizedPayment() {

    },

    onFileChange(e) {
      //this.file = e.target.files[0];
    },

    asset(path) {
      let base_path = window._asset || '';
      return base_path + path;
    },

    async pay() {
      this.processing = true
      await axios.get('/sanctum/csrf-cookie')

      const config = {
        headers: {'content-type': 'multipart/form-data'}
      }

      let formData = new FormData();
      //formData.append('file', this.file);
      // formData.append('payment_method', this.issuer);
      formData.append('payment_amount', this.requested_amt);
      formData.append('currency_from', this.cur_from);
      formData.append('currency_to', this.cur_to);

      if (!this.authenticated) {
        formData.append('password', this.user.password);
        formData.append('email', this.user.email);
      }

      await axios.post(this.url, formData, config).then(({data}) => {
        this.validationErrors = {}
        this.payment_id = data.payment_id
        if (!this.authenticated) {
          this.signIn(data)
        }
      }).catch((data) => {
        console.log(data)
        if (data.response.status === 422 && !this.firstTime) {
          this.validationErrors = data.response.data.errors
        } else {
          this.validationErrors = {}
          alert(data.data.message)
        }
      }).finally(() => {
        this.processing = false
      })

      if (Object.keys(this.validationErrors).length === 0) {
        this.step++;
      }
    }
  },

  computed: {
    isMobile: function () {
      return window.screen.availWidth <= 540
    },
    paymentRequisitesStep: function () {
      if (this.$store.state.auth.authenticated && !this.firstTime) {
        return 2;
      } else {
        return 3;
      }
    },
    paymentConfirmationStep: function () {
      if (this.$store.state.auth.authenticated && !this.firstTime) {
        return 3;
      } else {
        return 4;
      }
    },
    paymentThanksStep: function () {
      if (this.$store.state.auth.authenticated && !this.firstTime) {
        return 4;
      } else {
        return 5;
      }
    },
    url: function () {
      if (this.$store.state.auth.authenticated) {
        return '/api/payment';
      } else {
        return '/api/payment-register';
      }
    },
    authenticated: function () {
      return this.$store.state.auth.authenticated;
    }
  },

  watch: {
    async requested_amt(newValue, oldValue) {
      this.$refs.rate_ref.style.color = "grey";
      this.calculated_amt = 'Считаем...'
      console.log(newValue)

      if (this.ongoingRequest) {
        controller.abort()
        controller = new AbortController()
        this.ongoingRequest = false
      }
      //
      if (newValue !== null && newValue > 0) {
        this.calculating_amt = true;
      }
      //
      // if (newValue !== undefined && newValue !== null && (newValue < 50 || newValue > 1500)) {
      //   this.alertOfAmount = true;
      //   return;
      // } else {
      //   this.alertOfAmount = false;
      // }
      //
      this.debouncedFetch(newValue, oldValue);
    }
  },


  created() {
    this.debouncedFetch = debounce(async (newValue, oldValue) => {
      let url = `/api/convert?amount=${this.requested_amt}`;
      this.ongoingRequest = true;
      await axios.get(url, {signal: controller.signal}).then(({data}) => {
        this.ongoingRequest = false;
        this.calculating_amt = false;
        this.$refs.rate_ref.style.color = "white";
        this.calculated_amt = data.result + ' ' + this.cur_from;
      }).catch(({data}) => {
        if (data.status === 422) {
          this.calculating_amt = false;
          this.$refs.rate_ref.style.color = "white";
          this.validationErrors = data.data.errors
        } else {
          this.validationErrors = {}
          alert(data.data.message)
        }
      })
    }, 1000);
  }
}
</script>

<style lang="scss">

.cur_legend {
  color: wheat;
  font-size: 1.2em;
  border-bottom: 1px solid #e76912;
  margin-bottom: 10px;
}

.main-register {
  height: 100%;

  .main-exchange-form {
    height: 350px;
    width: 60%;
    padding: 40px;
    border-radius: 25px;
    display: flex;
    flex-direction: column;
    align-content: flex-end;
    justify-content: space-evenly;
    align-items: start;
    flex-wrap: nowrap;
    border: 1px solid #873b06;
    background: #130a01;
    margin: 0 auto 100px auto;

    h1 {
      color: #e76912;
    }

    .exchange-text-input {
      height: 2.3em;
      margin-top: 1vh;
      margin-bottom: 1vh;
      width: 90%;
      border-radius: 1.5em;
      padding: 1.1em;
      background: #2c1702;
      border: 0;
      outline: none;
      color: white;
    }

    .register-button {
      background: #e76912;
      margin-top: 7vh;
      margin-bottom: 1vh;
      border-radius: 5px;
      border: 0 black;
      padding: 1rem;
      cursor: pointer;
      text-align: center;
      display: flex;
      justify-content: center;
      align-items: center;

      &:hover {
        background: #e75212;
      }
    }

  }
}

.fields_container {
  display: flex;
  flex-direction: row;
}

.glow {
  box-shadow: 0 0 10px 10px #e76912,
  0 0 10px 15px #e75212;

  &:hover {
    box-shadow: 0 0 10px 10px #e75212,
    0 0 10px 10px #e85a41;
  }
}

.successful_payment {
  width: 100%;
  text-align: center;
  color: wheat;
}

.button_container {
  margin-top: 3em;
  display: flex;
  width: 100%;
  justify-content: center;

  button {
    background: #e76912;
    margin-bottom: 1vh;
    border-radius: 5px;
    border: 0 black;
    padding: 5px;
    cursor: pointer;
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;

    &:hover {
      background: #e75212;
    }
  }
}

.glow {
  box-shadow: 0 0 10px 10px #e76912,
  0 0 10px 15px #e75212;

  &:hover {
    box-shadow: 0 0 10px 10px #e75212,
    0 0 10px 10px #e85a41;
  }
}

.login_pass_container {
  margin-top: 10px;
  color: wheat;
  font-size: 1.2em;
  text-align: center;
}

.amts_container, .login_pass_container, .to_cur_container, .from_cur_container {
  width: 25%;

  &.logged_in {
    width: 33% !important;
  }
}

.rate__container {
  margin-top: 10px;
  color: wheat;
  font-size: 1.2em;
  display: flex;
  flex-direction: row;
}

.form_radio_btn {
  display: inline-block;
  margin-right: 10px;
}

.form_radio_btn input[type=radio] {
  display: none;
}

.form_radio_btn label {
  border: none;
  color: white;
  background: #2c1702;
  display: inline-block;
  cursor: pointer;
  padding: 0px 15px;
  line-height: 34px;
  border-radius: 15px;
  width: 100px;
  margin-bottom: 5px;
  user-select: none;
}

/* Checked */
.form_radio_btn input[type=radio]:checked + label {
  border: 1px solid #e75212;
}

/* Hover */
.form_radio_btn label:hover {
  color: #666;
}

/* Disabled */
.form_radio_btn input[type=radio]:disabled + label {
  background: #efefef;
  color: #666;
}

.to_cur_container {
  padding: 0.5em;
}

.from_cur_container {
  padding: 0.5em;
}

.rate__inside_container {
  text-align: center;
}

.amt__inside_container {
  text-align: center;
}

@media screen and (max-width: 780px) {
  .header {
    display: block;
  }

  .header__items {
    justify-content: space-evenly;

    .header__link {
      font-size: 3vw;
    }
  }


  .main-register {
    height: 100%;

    .main-exchange-form {
      margin-top: 30px;
      width: 80%;


      h1 {
        color: #e76912;
      }

      .exchange-text-input {
        padding: 1.1em;
      }

      .register-button {
        padding: 0.5rem;
      }
    }
  }
}


</style>