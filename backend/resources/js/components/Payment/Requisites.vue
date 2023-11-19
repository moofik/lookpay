<template>
  <div class="donation-requisites" v-if="number">
<!--    <svg-->
<!--        xmlns="http://www.w3.org/2000/svg"-->
<!--        xmlns:xlink="http://www.w3.org/1999/xlink"-->
<!--        width="6em" >-->
<!--      <icon1.svg  x="0px" y="0px" width="6em" xlink:href="data:img/png;base64,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" />-->
<!--    </svg>-->
    <p class="donation-description-1 d-inline-block">
      {{$t('requisites_1', {amt: this.amount, cur: this.currency, issuer: this.issuer})}}
    </p>
  </div>

  <div class="donation-requisites">
    <div class="donation-description-2 d-inline-block">
      <p><span>{{$t('account_number')}}:</span> <span>{{number}}</span><span>&nbsp;{{bank}}</span></p>
      <p v-if="name"><span>{{$t('payee_name')}}:</span> {{name}}</p>
      <a class="copy-btn" href="#" @click="copyText">{{$t('copy_requisites')}}</a>
    </div>
  </div>
  <div v-if="reqimage">
    <img style="width: 80%" :src="reqimage" alt="payment requisites"/>
  </div>
  <div class="donation-requisites">
<!--    <p class="donation-description-3 d-inline-block">-->
<!--      If needed, you can leave a comment for the payment.-->
<!--    </p>-->
<!--    <p class="donation-description-4 d-inline-block">-->
<!--      {{$t('req_attention')}}-->
<!--    </p>p-->
  </div>
</template>

<script>

const Requisites = () => import('@/components/Payment/Requisites.vue');

export default {
  name: "Requisites",
  components: {Requisites},
  methods: {
    async copyText() {
      if (navigator.clipboard && window.isSecureContext) {
        await navigator.clipboard.writeText(this.number.replace(/-|\s/g,""));
      } else {
        const textArea = document.createElement("textarea");
        textArea.value = this.number.replace(/-|\s/g,"");
        textArea.style.position = "absolute";
        textArea.style.left = "-999999px";
        document.body.prepend(textArea);
        textArea.select();

        try {
          document.execCommand('copy');
        } catch (error) {
          console.error(error);
        } finally {
          textArea.remove();
        }
      }
    }
  },
  props: {
    number: {
      type: String,
      required: false,
      default: null
    },

    bank: {
      type: String,
      required: false,
      default: ''
    },

    name: {
      type: String,
      required: false,
      default: null
    },
    issuer: {
      type: String,
      required: false,
      default: null
    },

    reqimage: {
      type: String,
      required: false,
      default: null
    },

    amount: {
      type: Number,
      required: false,
      default: null
    },

    currency: {
      type: String,
      required: false,
      default: null
    }
  }
}
</script>

<style scoped>
p:last-child {
  margin: 0;
}

.arrow-highlight {
  position: relative;
  margin: 0 0.5em;
  padding: 0 0.2em;
}

.arrow-highlight:before {
  content: "";
  z-index: -1;
  left: -0.5em;
  top: 0.1em;
  border-width: 0.5em;
  border-style: solid;
  border-color: orange;
  position: absolute;
  width: calc(100% - 0.5em);
  border-left-color: transparent;
}

.arrow-highlight:after {
  content: "";
  z-index: -1;
  right: 0;
  top: 0.1em;
  border-width: 0.5em;
  border-style: solid;
  border-color: orange;
  position: absolute;
  border-top-color: transparent;
  border-bottom-color: transparent;
  border-left-color: transparent;
  transform: rotate(180deg);
  transform-origin: center right;
}

.copy-btn {
  text-decoration: underline;
  color: white;
}

.copy-btn:active {
  text-decoration: underline;
  color: #decccc;
}

.donation-description-1 {
  color: white;
  background: #4c9f81;
  border: 10px;
  margin-top: 1em;
  border-radius: 5em;
  padding: 1.7em 2.5em 1.7em 2.5em;
  font-size: 0.8em;
  position: relative;
  width: 100%;
}

.donation-description-1::before {
  position: absolute;
  color: white;
  background: #091013;
  border: 10px;
  width: 5em;
  height: 5em;
  border-radius: 10em;
  content: '';
  left: -2.5em;
  top: 2.3em;
}

.donation-description-1::after {
  position: absolute;
  color: white;
  background-image: url("/images/icon1.png");
  background-position: center;
  background-size: 3.3em 3.3em;
  background-repeat: no-repeat;
  border: 10px;
  width: 3.4em;
  height: 3.4em;
  border-radius: 3em;
  content: '';
  left: -1.6em;
  top: 3.2em;
}

.donation-description-2 {
  color: white;
  background: #7aae96;
  border: 10px;
  margin-top: 1em;
  border-radius: 5em;
  padding: 1.7em 2.5em 1.7em 2.5em;
  font-size: 0.8em;
  width: 100%;
}

.donation-description-3 {
  color: white;
  background: #ff5b03;
  border: 10px;
  margin-top: 1em;
  margin-bottom: 0 !important;
  border-radius: 5em;
  padding: 1.7em 2.5em 1.7em 2.5em;
  font-size: 0.8em;
  position: relative;
  width: 100%;
}


.donation-description-3::before {
  position: absolute;
  color: #091013;
  background: #091013;
  border: 10px;
  width: 5em;
  height: 5em;
  border-radius: 10em;
  content: '';
  left: -2.5em;
  top: 0.8em;
}

.donation-description-3::after {
  position: absolute;
  color: #091013;
  background-image: url("/images/icon2.png");
  background-position: center;
  background-size: 3.3em 3.3em;
  background-repeat: no-repeat;
  border: 10px;
  width: 3.4em;
  height: 3.4em;
  border-radius: 3em;
  content: '';
  left: -1.6em;
  top: 1.6em;
}


.donation-description-4 {
  color: white;
  font-weight: bold;
  padding: 1.3em;
  font-size: 0.8em;
  width: 100%;
}

.donation-requisites {
  width: 80%;
  margin: 0 auto;
  text-align: center;
}


@media (min-width: 420px) and (max-width: 540px) {
  .donation-description-1::before {
    position: absolute;
    color: #091013;
    background: #091013;
    border: 10px;
    width: 5em;
    height: 5em;
    border-radius: 10em;
    content: '';
    left: -2.8em;
    top: 1.5em;
  }

  .donation-description-1::after {
    position: absolute;
    color: #091013;
    background-image: url("/images/icon1.png");
    background-position: center;
    background-size: 3.3em 3.3em;
    background-repeat: no-repeat;
    border: 10px;
    width: 3.4em;
    height: 3.4em;
    border-radius: 3em;
    content: '';
    left: -1.6em;
    top: 2.3em;
  }

  .donation-description-3::before {
    position: absolute;
    color: #091013;
    background: #091013;
    border: 10px;
    width: 5em;
    height: 5em;
    border-radius: 10em;
    content: '';
    left: -2.8em;
    top: 0.6em;
  }

  .donation-description-3::after {
    position: absolute;
    color: #091013;
    background-image: url("/images/icon2.png");
    background-position: center;
    background-size: 3.3em 3.3em;
    background-repeat: no-repeat;
    border: 10px;
    width: 3.4em;
    height: 3.4em;
    border-radius: 3em;
    content: '';
    left: -1.6em;
    top: 1.4em;
  }
}

@media (min-width: 540px) and (max-width: 770px) {
  .donation-description-1::before {
    position: absolute;
    color: #091013;
    background: #091013;
    border: 10px;
    width: 5em;
    height: 5em;
    border-radius: 10em;
    content: '';
    left: -2.8em;
    top: 0.8em;
  }

  .donation-description-1::after {
    position: absolute;
    color: #091013;
    background-image: url("/images/icon1.png");
    background-position: center;
    background-size: 3.3em 3.3em;
    background-repeat: no-repeat;
    border: 10px;
    width: 3.4em;
    height: 3.4em;
    border-radius: 3em;
    content: '';
    left: -1.6em;
    top: 1.6em;
  }

  .donation-description-3::before {
    position: absolute;
    color: #091013;
    background: #091013;
    border: 10px;
    width: 5em;
    height: 5em;
    border-radius: 10em;
    content: '';
    left: -2.8em;
    top: 0.1em;
  }

  .donation-description-3::after {
    position: absolute;
    color: #091013;
    background-image: url("/images/icon2.png");
    background-position: center;
    background-size: 3.3em 3.3em;
    background-repeat: no-repeat;
    border: 10px;
    width: 3.4em;
    height: 3.4em;
    border-radius: 3em;
    content: '';
    left: -1.6em;
    top: 1em;
  }
}

@media (min-width: 770px) and (max-width: 992px) {
  .donation-description-1::before {
    position: absolute;
    color: #091013;
    background: #091013;
    border: 10px;
    width: 5em;
    height: 5em;
    border-radius: 10em;
    content: '';
    left: -2.8em;
    top: 1.5em;
  }

  .donation-description-1::after {
    position: absolute;
    color: #091013;
    background-image: url("/images/icon1.png");
    background-position: center;
    background-size: 3.3em 3.3em;
    background-repeat: no-repeat;
    border: 10px;
    width: 3.4em;
    height: 3.4em;
    border-radius: 3em;
    content: '';
    left: -1.6em;
    top: 2.3em;
  }

  .donation-description-3::before {
    position: absolute;
    color: #091013;
    background: #091013;
    border: 10px;
    width: 5em;
    height: 5em;
    border-radius: 10em;
    content: '';
    left: -2.8em;
    top: 0.1em;
  }

  .donation-description-3::after {
    position: absolute;
    color: #091013;
    background-image: url("/images/icon2.png");
    background-position: center;
    background-size: 3.3em 3.3em;
    background-repeat: no-repeat;
    border: 10px;
    width: 3.4em;
    height: 3.4em;
    border-radius: 3em;
    content: '';
    left: -1.6em;
    top: 1em;
  }
}


@media (min-width: 992px) and (max-width: 1399px) {
  .donation-description-1::before {
    position: absolute;
    color: #091013;
    background: #091013;
    border: 10px;
    width: 5em;
    height: 5em;
    border-radius: 10em;
    content: '';
    left: -2.8em;
    top: 0.8em;
  }

  .donation-description-1::after {
    position: absolute;
    color: #091013;
    background-image: url("/images/icon1.png");
    background-position: center;
    background-size: 3.3em 3.3em;
    background-repeat: no-repeat;
    border: 10px;
    width: 3.4em;
    height: 3.4em;
    border-radius: 3em;
    content: '';
    left: -1.6em;
    top: 1.6em;
  }

  .donation-description-3::before {
    position: absolute;
    color: #091013;
    background: #091013;
    border: 10px;
    width: 5em;
    height: 5em;
    border-radius: 10em;
    content: '';
    left: -2.8em;
    top: 0;
  }

  .donation-description-3::after {
    position: absolute;
    color: #091013;
    background-image: url("/images/icon2.png");
    background-position: center;
    background-size: 3.3em 3.3em;
    background-repeat: no-repeat;
    border: 10px;
    width: 3.4em;
    height: 3.4em;
    border-radius: 3em;
    content: '';
    left: -1.6em;
    top: 0.9em;
  }
}

@media (min-width: 1400px) {
  .donation-description-1::before {
    position: absolute;
    color: #091013;
    background: #091013;
    border: 10px;
    width: 5em;
    height: 5em;
    border-radius: 10em;
    content: '';
    left: -2.8em;
    top: 0.8em;
  }

  .donation-description-1::after {
    position: absolute;
    color: #091013;
    background-image: url("/images/icon1.png");
    background-position: center;
    background-size: 3.3em 3.3em;
    background-repeat: no-repeat;
    border: 10px;
    width: 3.4em;
    height: 3.4em;
    border-radius: 3em;
    content: '';
    left: -1.6em;
    top: 1.7em;
  }

  .donation-description-3::before {
    position: absolute;
    color: #091013;
    background: #091013;
    border: 10px;
    width: 5em;
    height: 5em;
    border-radius: 10em;
    content: '';
    left: -2.8em;
    top: 0;
  }

  .donation-description-3::after {
    position: absolute;
    color: #091013;
    background-image: url("/images/icon2.png");
    background-position: center;
    background-size: 3.3em 3.3em;
    background-repeat: no-repeat;
    border: 10px;
    width: 3.4em;
    height: 3.4em;
    border-radius: 3em;
    content: '';
    left: -1.6em;
    top: 0.9em;
  }
}

.container {
  display: flex;
  align-items: center;
  justify-content: flex-start;
  width: 300px; /* Задайте нужную ширину контейнера */
}

.circle {
  width: 6em;
  height: 6em;
  border-radius: 50%;
  background: url('ваш_файл.svg') no-repeat center center;
  background-size: cover;
}

.outer-border {
  width: 20px; /* Ширина внешней рамки */
  height: 100%;
  border-radius: 50%;
  border: 10px solid #000; /* Цвет и толщина внешней рамки */
  margin-right: 20px; /* Расстояние между кружком и рамкой справа */
  position: relative;
}

.inner-border {
  width: 20px; /* Ширина внутренней рамки */
  height: 100%;
  border-radius: 50%;
  border: 10px solid #000; /* Цвет и толщина внутренней рамки */
  margin-left: -20px; /* Расстояние между кружком и рамкой слева (делаем вогнутой) */
  position: relative;
}

#aux-container {
  width: 100px;
  height: 100px;
  background: #f00;
  -webkit-mask-image: radial-gradient(circle 10px at 0 0, transparent 0, transparent 20px, black 21px);
}

</style>