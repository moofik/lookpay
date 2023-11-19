<template>
  <section class="h-100 gradient-form">
    <div class="container-md py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-xl-10">
          <div class="card rounded-3 text-black">
            <div class="row g-0">
              <div class="col-lg-12">
                <div class="card-body p-md-5 mx-md-4">

                  <div class="text-center">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/lotus.webp"
                         style="width: 185px;" alt="logo">
                    <!--<h4 class="mt-1 mb-5 pb-1">Payment</h4>-->
                  </div>

                  <section class="section-form">
                    <div class="section-form-stepper">
                      <div class="step" :class="{'step-active' : step === 1, 'step-done': step > 1}"><span
                          class="step-number">1</span></div>
                      <div class="step" :class="{'step-active' : step === 2, 'step-done': step > 2}"><span
                          class="step-number">2</span></div>
                      <div class="step" :class="{'step-active' : step === 3, 'step-done': step > 3}"><span
                          class="step-number">3</span></div>
                    </div>

                    <div class="col-12" v-if="Object.keys(validationErrors).length > 0">
                      <div class="alert alert-danger">
                        <ul class="mb-0">
                          <li v-for="(value, key) in validationErrors" :key="key">{{ value[0] }}</li>
                        </ul>
                      </div>
                    </div>

                    <transition name="slide-fade">
                      <form v-show="step===1" action="javascript:void(0)" @submit.prevent="next"
                            class="row col-8 m-auto" method="post">
                        <h2>Payment details</h2>

                        <div class="form-outline mb-4">
                          <label for="donation_type" class="col-sm-12 control-label">Select donation type</label>
                          <select name="donation_type" id="donation_type"
                                  class="form-select" v-model.number="donation_type">
                            <option selected disabled value="">Donation type</option>
                            <option value="1">
                              Basketball championship among the disabled people
                            </option>
                            <option value="2">
                              Dobrosite tokens presale
                            </option>
                          </select>
                        </div>

                        <div class="form-outline mb-4">
                          <label for="issuer" class="col-sm-12 control-label">Select payment method</label>
                          <select name="issuer" id="issuer"
                                  class="form-select" v-model="issuer">
                            <option value="" selected disabled>
                              Payment method
                            </option>
                            <option value="Line">
                              Line
                            </option>
                            <option value="WeChat">
                              WeChat
                            </option>
                            <option value="BANGKOK BANK">
                              BANGKOK BANK
                            </option>
                            <option value="KASIKORN BANK">
                              KASIKORN
                            </option>
                            <option value="SBERBANK">
                              SBERBANK
                            </option>
                            <option value="TINKOFF">
                              TINKOFF
                            </option>
                            <option value="СБП">
                              СБП
                            </option>
                            <option value="QR СБП">
                              QR СБП
                            </option>
                            <option value="QR СБЕР">
                              QR СБЕР
                            </option>
                            <option value="QR BANGKOK BANK">
                              QR BANGKOK
                            </option>
                            <option value="QR KASIKORN">
                              QR KASIKORN
                            </option>
                            <option value="BTC">
                              BTC
                            </option>
                            <option value="ETH">
                              ETH
                            </option>
                            <option value="USDT">
                              USDT
                            </option>
                          </select>
                        </div>

                        <div v-show="currency !== null && donation_type !== null" class="form-outline mb-4">
                          <label for="amount" class="col-sm-12 control-label">Enter {{ this.currency }} amount</label>
                          <input type="number" name="amount" v-model.number="amount" id="amount" class="form-control"/>
                        </div>

                        <h4 v-show="tokens !== null">YOU WILL GET {{ this.tokens }} TOKENS</h4>

                        <div class="text-center pt-1 mb-5 pb-1">
                          <button v-show="tokens !== null" type="submit" :disabled="processing"
                                  class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3">
                            {{ processing ? "Please wait" : "Next" }}
                          </button>
                          &nbsp;
                          <!--<a class="text-muted" href="#!">Forgot password?</a>-->
                        </div>

                      </form>
                    </transition>


                    <transition name="slide-fade">
                      <form v-show="step===2" action="javascript:void(0)" @submit.prevent="next"
                            class="row col-8 m-auto" method="post">
                        <h2>Payment requisites</h2>
                        <div class="form-outline mb-4">
                          <Requisites v-bind="requisitesProps"></Requisites>
                        </div>

                        <div class="text-center pt-1 mb-5 pb-1">
                          <button type="button" @click="prev" :disabled="processing"
                                  class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3">
                            {{ processing ? "Please wait" : "Back" }}
                          </button>
                          &nbsp;
                          <button type="submit" :disabled="processing"
                                  class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3">
                            {{ processing ? "Please wait" : "Next" }}
                          </button>
                          &nbsp;
                        </div>
                      </form>
                    </transition>


                    <transition name="slide-fade">
                      <form v-show="step===3" action="javascript:void(0)" @submit.prevent="pay"
                            class="row col-8 m-auto" method="post">
                        <h2>Payment confirmation</h2>
                        <strong>Attach a receipt confirming the payment:</strong>
                        <input type="file" class="form-control" v-on:change="onFileChange"/>

                        <div class="text-center pt-1 mb-5 pb-1">
                          <button type="button" @click="prev" :disabled="processing"
                                  class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3">
                            {{ processing ? "Please wait" : "Back" }}
                          </button>
                          &nbsp;
                          <button type="submit" :disabled="processing"
                                  class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3">
                            {{ processing ? "Please wait" : "Pay" }}
                          </button>
                          &nbsp;
                        </div>
                      </form>
                    </transition>


                    <transition name="slide-fade">
                      <div v-show="step===4">
                        <h2>Thanks for the donation!</h2>
                        <button :disabled="processing" @click="payAgain"
                                class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3">
                          {{ processing ? "Please wait" : "Make another donation" }}
                        </button>
                      </div>
                    </transition>

                  </section>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import {mapActions} from 'vuex'
import Requisites from "@/components/Payment/Requisites.vue";

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

export default {
  name: 'register',
  components: {Requisites},
  data() {
    return {
      steps: {},
      step: 1,
      donation_type: null,
      currency: null,
      issuer: null,
      amount: null,
      tokens: null,
      file: null,
      validationErrors: {},
      processing: false,
      paymentCompleted: false
    }
  },
  methods: {
    ...mapActions({
      signIn: 'auth/loginWithoutRedirect',
    }),

    payAgain()
    {
      this.steps = {}
      this.step = 1
      this.donation_type = null
      this.currency = null
      this.issuer = null
      this.amount = null
      this.tokens = null
      this.file = null
      this.validationErrors = {}
      this.processing = false
      this.paymentCompleted = false
    },

    onFileChange(e){
      this.file = e.target.files[0];
    },

    asset(path) {
      let base_path = window._asset || '';
      return base_path + path;
    },

    prev() {
      this.step--;
    },

    next() {
      this.step++;
    },

    async pay() {
      this.step++;
      this.processing = true
      await axios.get('/sanctum/csrf-cookie')

      let url = '/api/payment';

      const config = {
        headers: {'content-type': 'multipart/form-data'}
      }

      let formData = new FormData();
      formData.append('file', this.file);
      formData.append('donation_type', this.donation_type);
      formData.append('currency', this.currency);
      formData.append('payment_method', this.issuer);
      formData.append('payment_amount', this.amount);

      await axios.post(url, formData, config).then(({data}) => {
        this.validationErrors = {}

        if (!this.$store.state.auth.authenticated) {
          this.signIn(data)
          this.paymentCompleted = true;
        }
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
    }
  },
  watch: {
    async amount(newValue, oldValue) {
      this.loadTokenAmount = true;
      this.debouncedFetch(newValue, oldValue);
    },
    issuer(newValue, oldValue) {
      switch (newValue) {
        case "Line":
        case "WeChat":
        case "BANGKOK BANK":
        case "KASIKORN BANK":
        case "QR BANGKOK BANK":
        case "QR KASIKORN":
          this.currency = 'THB'
          break;

        case "BTC":
          this.currency = 'BTC'
          break;
        case "ETH":
          this.currency = 'ETH'
          break;
        case "USDT":
          this.currency = 'USDT'
          break;

        default:
          this.currency = 'RUB'
          break;
      }
    },
  },
  computed: {
    requisitesProps: function() {
      let qrAssetDemo = this.asset('images/1.png')

      switch (this.issuer) {
        case "Line":
          return {
            number: '123',
            name: 'MR. Line'
          }

        case "WeChat":
          return {
            number: '123',
            name: 'MR. We chat'
          }

        case "BANGKOK BANK":
          return {
            number: '676-0-363298',
            name: ' MR. Pavel Tikhonov'
          }

        case "KASIKORN BANK":
          return {
            number: '146-8-52538-7',
            name: 'ALEKSANDR DUSHENKIN'
          }

        case "QR BANGKOK BANK":
          return {
            reqimage: qrAssetDemo
          }

        case "QR KASIKORN":
          return {
            reqimage: qrAssetDemo
          }

        case "BTC":
          return {
            number: '15buBy2NmK1aVaq5dgA5a7tXFicqRw7E91'
          }

        case "ETH":
          return {
            number: '0x5ff12b5b19168ef4c06cabda2dca0bd3bb426148'
          }

        case "USDT":
          return {
            number: 'TRHt4mxa39BwzgmwdBjS7hCqaF67JWqptA'
          }

        default:
          return {
            reqimage: qrAssetDemo
          }
      }
    }
  },
  created() {
    this.debouncedFetch = debounce(async (newValue, oldValue) => {
      let url = `/api/convert?amount=${this.amount}&from=${this.currency}&type=${this.donation_type}`;

      await axios.get(url).then(({data}) => {
        this.loadTokenAmount = false;
        this.tokens = data.result.tokensAmt;
      }).catch(({data}) => {
        if (data.status === 422) {
          this.loadTokenAmount = false;
          this.validationErrors = data.data.errors
        } else {
          this.validationErrors = {}
          alert(data.data.message)
        }
      })
    }, 1000);
  },
}
</script>

<style lang="scss">
.gradient-custom-2 {
  /* fallback for old browsers */
  background: #fccb90;

  /* Chrome 10-25, Safari 5.1-6 */
  background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #e20c0c);

  /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
  background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #d81212);
}

@media (min-width: 768px) {
  //.gradient-form {
  //  height: 100vh !important;
  //}
}

@media (min-width: 769px) {
  .gradient-custom-2 {
    border-top-right-radius: .3rem;
    border-bottom-right-radius: .3rem;
  }
}

$brand-primary: #ff6400;
$brand-secondary: #dedc00;
$brand-lemon: #fff219;
$brand-quaternary: #f282a5;
$brand-menthol: #c3500a;
$brand-coral: rgb(250, 90, 85);
$brand-paprika: rgb(205, 0, 125);
$color-white: #fff;
$color-dark: #676767;
$color-gray: #cecece;
$color-lightgray: #ededed;
$color-jungle: #193805;

/* FONT */
$font-montserrat: "Montserrat", sans-serif;
$font-weight-bold: 700;

.payment-info {
  width: 600px;
}

.pen-description {
  display: flex;
  flex-flow: column;
  align-items: center;
  font-family: $font-montserrat;

  h1 {
    text-align: center;
    margin-top: 2rem;
    color: $color-white;
  }

  p {
    margin: 0;
    line-height: 1;
  }

  .pen-copyright {
    img {
      border-radius: 25px;
      padding: 5px;
      margin: 5px;
      transition: box-shadow .5s ease-in-out;
    }

    &:hover img {
      box-shadow: 0 10px 20px #0e2101;
    }
  }
}

.section-form {
  h2 {
    text-align: center;
    color: rgba(121, 113, 113, 0.99);
    line-height: 1.2;
    font-weight: 500;
    font-size: 34px;
    margin-bottom: 40px;
  }

  &-stepper {
    display: flex;
    justify-content: space-between;
    width: 100%;
    position: relative;
    margin: 0 auto 1.5em;

    &::before {
      z-index: 0;
      content: "";
      display: block;
      position: absolute;
      height: 2px;
      top: calc(50% - 1px);
      background: $color-gray;
      width: calc(100% - 20px);
    }

    .step {
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 2;
      border: 2px solid $color-gray;
      color: $color-gray;
      background-color: $color-white;
      border-radius: 50%;
      min-width: 25px;
      min-height: 25px;
      line-height: 20px;
      font-size: 16px;

      &-active {
        color: $brand-primary;
        background-color: $color-white;
        border-color: $brand-primary;
      }

      &-done {
        color: #ff9f5a;
        border-color: #ff9a4f;
      }

      &-number {
        font-family: $font-montserrat;
        font-weight: 800;
        line-height: 1;
        vertical-align: middle;
      }
    }
  }

  // Transition SLIDE FADE
  .slide-fade-enter-active {
    transition: all 0.4s ease-out;
  }

  .slide-fade-leave-active {
    display: none;
    transition: all 0.4s cubic-bezier(1, 0.5, 0.8, 1);
  }

  .slide-fade-enter-from, .slide-fade-leave-to {
    transform: translateX(10px);
    opacity: 0;
  }
}


</style>