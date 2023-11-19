<template>
  <main class="content">
    <div class="background__fone">
      <section class="lead">
        <h1 class="header__title">САМЫЙ ПРОСТОЙ СПОСОБ ОБМЕНА</h1>
        <p class="header__text">MIX PAY - безопасная и удобная система обмена криптовалюты, позволяет легко покупать и продавать BITCOIN, ETHEREUM и USDT</p>
        <ul class="header__change">
          <li>
            <p class="change__value">₽666.69</p>
            <p class="change__trade">Покупка</p>
          </li>
          <li>
            <p class="change__value">₽14.88</p>
            <p class="change__trade">Продажа</p>
          </li>
          <li>
            <p class="change__value">₿666.69</p>
            <p class="change__trade">Покупка</p>
          </li>
          <li>
            <p class="change__value">₿14.88</p>
            <p class="change__trade">Продажа</p>
          </li>
        </ul>
        <div class="header__button">
          <a class="button__link" href="/exchange">Обменять</a>
        </div>
        <img src="/images/big_cube.png" alt="первый куб" class="one__cube">
        <img src="/images/big_cube.png" alt="второй куб" class="two__cube">
        <img src="/images/medium_cube.png" alt="третий куб" class="three__cube">
        <img src="/images/medium_cube.png" alt="четвёртый куб" class="four__cube">
        <img src="/images/little_cube.png" alt="пятый куб" class="five__cube">
      </section>
      <section class="crypto">
        <img src="/images/crypto_line.png" alt="фон под значки" class="crypto__line">
        <div class="crypto__symbols">
          <img src="/images/bitcoin.png" alt="значок биткоин" class="crypto__symbol">
          <img src="/images/tether.png" alt="значок тезер" class="crypto__symbol">
          <img src="/images/ethereum.png" alt="значок 'этериум" class="crypto__symbol">
        </div>
      </section>
      <section class="review">
        <h2 class="review__title">Почему Mix pay?</h2>
        <img src="/images/fone_text.png" alt="фон под текст" class="fone__text">
        <div class="review__button">
          <a class="button__link" href="#">Обменять</a>
        </div>
        <p class="review__text_one">MIX PAY - Это супер система для обмена !!1!! Я прям кайфанул когда использовал ее, обмен произошел моментально !</p>
  <!--      <h3 class="review__text_title">MIX PAY</h3>-->
        <p class="review__text_two">Простота и быстрота покупки и продажи криптовалют - вот что делает систему MIX PAY непревзойденной.</p>
      </section>
    </div>
    <section class="profit">
      <div class="profit__background_one">
        <h3 class="profit__title_one">Выгода</h3>
        <p class="profit__text_one">Приглашайте новых пользователей через реферальную программу и получайте свой выбранный процент с каждой сделки</p>
      </div>
      <div class="profit__background_two">
        <h3 class="profit__title_two">Cкорость</h3>
        <p class="profit__text_two">Подключайте платежную систему для вашего бизнеса - это ускорит и увеличит способы оплаты на сайте ваших услуг.</p>
      </div>
      <div class="profit__background_three">
        <h3 class="profit__title_three">География</h3>
        <p class="profit__text_three">Россия, Казахстан, Украина, Беларусь и другие страны СНГ. В 2023 году запускаем весь мир.</p>
      </div>
    </section>
    <section class="phones">
      <img src="/images/phones.png" alt="два смартфона" class="phones__img">
      <h2 class="phones__title">Оплата в BITCOIN, ETHEREUM, USD TETHER</h2>
      <div class="phones__button">
        <a class="button__link" href="#">Обменять</a>
      </div>
    </section>
    <section class="cooperation">
      <h2 class="cooperation__title">ПОПРОБУЙТЕ MIX PAY СЕГОДНЯ И УБЕДИТЕСЬ В ЕГО НАДЕЖНОСТИ И УДОБСТВЕ ИСПОЛЬЗОВАНИЯ</h2>
<!--      <nav class="cooperation__menu">-->
<!--        <ul class="cooperation__items">-->
<!--          <li class="cooperation__item">-->
<!--            <a class="cooperation__links" href="#">O Mix pay</a>-->
<!--          </li>-->
<!--          <li class="cooperation__item">-->
<!--            <a class="cooperation__links" href="#">Обменять</a>-->
<!--          </li>-->
<!--          <li class="cooperation__item">-->
<!--            <a class="cooperation__links" href="#">Выбор валюты</a>-->
<!--          </li>-->
<!--          <li class="cooperation__item">-->
<!--            <a class="cooperation__links" href="#">Безопасность</a>-->
<!--          </li>-->
<!--        </ul>-->
<!--      </nav>-->
      <a class="cooperation__link" href="#">Сотрудничество</a>
      <img src="/images/mix_pay.png" alt="логотип сайта" class="cooperation__mixpay">
      <div class="cooperation__button">
        <a class="button__link" href="#">MIX PAY</a>
      </div>
    </section>
  </main>
</template>

<script>
import {mapActions} from 'vuex'

export default {
  name: "main",
  data() {
    return {
      user: this.$store.state.auth.user
    }
  },
  methods: {
    ...mapActions({
      signOut: "auth/logout"
    }),
    async logout() {
      await axios.post('/api/logout').then(({data}) => {
        this.signOut()
        this.$router.push({name: "login"})
      })
    }
  }
}
</script>

<style lang="scss">
@font-face {
  font-family: "Montserrat";
  font-weight: 300;
  font-style: normal;
  src: url(/fonts/Montserrat-Medium.ttf);
}

@font-face {
  font-family: "Montserrat";
  font-weight: 200;
  font-style:  normal;
  src: url(/fonts/Montserrat-Light.ttf);
}

@font-face {
  font-family: "Montserrat";
  font-weight: 700;
  font-style:  normal;
  src: url(/fonts/Montserrat-Bold.ttf);
}

@font-face {
  font-family: "Montserrat";
  font-weight: 600;
  font-style: normal;
  src: url(/fonts/Montserrat-SemiBold.ttf);
}

.content{
  margin: 0;
}


.lead{
  margin: 0;

  position: relative;
  bottom: 16vw;
  z-index: 1;
}


.header__title{
  color: #f5ebdb;
  font-weight: 700;
  font-size: 4vw;
  margin: 0 auto;
  position: absolute;
  z-index: 2;
  width: 40vw;
  top: 15.4vw;
  left: 16vw;
}

.header__button{
  margin: 0 auto;
  position: absolute;
  z-index: 2;
  top: 29.5vw;
  left: 16vw;
}

.button__link{
  text-decoration: none;
  color: #f5ebdb;
  font-weight: 300;
  font-size: 2vw;
  padding: 1vw 2vw;
  background-color: #e76912;
  border-radius: 20px;
}

.header__text{
  margin: 0 auto;
  position: absolute;
  z-index: 2;
  top: 37vw;
  left: 16vw;
  color: #f5ebdb;
  font-weight: 100;
  width: 39vw;
  font-size: 1.3vw;
}

.header__change{
  display: flex;
  justify-content: space-between;
  margin: 0 auto;
  padding: 0;
  position: absolute;
  z-index: 2;
  top: 29vw;
  left: 35vw;
  font-weight: 100;
  width: 39vw;
  list-style-type: none;
}

.change__value{
  color: #d77f3c;
  margin: 0;
  font-size: 2vw;
}

.change__trade{
  color: #f5ebdb;
  margin: 0;
  font-size: 0.9vw;
  padding-left: 1.2vw;
}

.cubes{
  margin: 0 auto;
}

.one__cube{
  margin: 0 auto;
  position: relative;
  z-index: 1;
  top: 28vw;
  left: 67.5vw;
  width: 30vw;
}

.two__cube{
  margin: 0 auto;
  position: absolute;
  z-index: 1;
  top: 16vw;
  left: 68vw;
  width: 18vw;
}

.three__cube{
  margin: 0 auto;
  position: absolute;
  z-index: 1;
  top: 8vw;
  left: 76vw;
  width: 14vw;
}

.four__cube{
  margin: 0 auto;
  position: absolute;
  z-index: 1;
  top: 8vw;
  left: 87vw;
  width: 7vw;
  filter: blur(1px);
}

.five__cube{
  margin: 0 auto;
  position: absolute;
  z-index: 1;
  top: 8vw;
  left: 94vw;
  width: 4vw;
}

.crypto{
  margin: 0;
  z-index: 2;
  position: relative;
}

.crypto__line{
  position: relative;
  top: 10vw;
  left: -5vw;
  margin: 0 auto;
  width: 98vw;
}

.crypto__symbols{
  position: relative;
  text-align: center;
  margin: 0 auto 0 auto;
  top: -3.5vw;

  img {
    padding-left: 5vw;
    padding-right: 5vw;
    margin: 0 auto 0 auto;
  }
}


.crypto__symbol{
  padding-right: 10vw;
  width: 17vw;
}


.review{
  margin: 0;
  z-index: 1;
  position: relative;
}

.background__img__two{
  margin: 0;
  width: 98vw;
  position: relative;
  z-index: 1;
  object-fit: cover;
}

.review__title{
  display: inline-block;
  color: #f5ebdb;
  font-weight: 700;
  font-size: 5vw;
  margin: 0;
  position: relative;
  z-index: 2;
  width: 25vw;
  left: 6vw;
}

.fone__text{
  margin: 0;
  position: relative;
  z-index: 2;
  width: 42vw;
  left: 18vw;
}

.review__button{
  margin: 0;
  position: relative;
  z-index: 2;
  left: 9vw;
}

.review__text_one{
  margin: 0;
  font-weight: 300;
  font-style: normal;
  color: #f5ebdb;
  font-size: 1.5vw;
  position: absolute;
  z-index: 3;
  width: 29vw;
  top: 5vw;
  left: 52vw;
}

.review__text_title{
  margin: 0;
  color: #f5ebdb;
  font-weight: 700;
  font-style: normal;
  font-size: 1.5vw;
  position: relative;
  z-index: 3;
  width: 29vw;
  bottom: 11vw;
  left: 51vw;
}

.review__text_two{
  margin: 0;
  color: #f5ebdb;
  font-weight: 300;
  font-style: normal;
  font-size: 1.5vw;
  position: absolute;
  z-index: 3;
  width: 37vw;
  top: 20vw;
  left: 46vw;
}



.profit{
  margin: 40px auto auto;
  display: flex;
  justify-content: space-evenly;
}

.profit__background_one{
  width: 300px;
  height: 334px;
  margin: 0;
  z-index: 3;
  background: url(/images/fone_profit_2.png) no-repeat;
  background-size: cover;
}

.profit__background_two{
  width: 300px;
  height: 334px;
  margin: 0;
  z-index: 3;
  background: url(/images/fone_fast_2.png) no-repeat;
  background-size: cover;
}

.profit__background_three{
  width: 300px;
  height: 334px;
  margin: 0;
  z-index: 3;
  background: url(/images/fone_geography_2.png) no-repeat;
  background-size: cover;
}

.profit__title_one{
  font-weight: 600;
  font-style: normal;
  font-size: 2.4vw;
  color: #f5ebdb;
  z-index: 4;
  margin-top: 130px;
  text-align: center;
}

.profit__title_two{
  font-weight: 600;
  font-style: normal;
  font-size: 2.4vw;
  color: #f5ebdb;
  z-index: 4;
  margin-top: 130px;
  text-align: center;
}

.profit__title_three {
  font-weight: 600;
  font-style: normal;
  font-size: 2.4vw;
  color: #f5ebdb;
  z-index: 4;
  margin-top: 130px;
  text-align: center;
}

.profit__text_one{
  padding: 0.8vw;
  margin: 0;
  font-weight: 500;
  font-style: normal;
  font-size: 0.8vw;
  color: #f5ebdb;
  text-align: center;
  z-index: 4;
  line-height: 1.5vw;
}

.profit__text_two{
  padding: 0.8vw;
  margin: 0;
  font-weight: 500;
  font-style: normal;
  font-size: 0.8vw;
  color: #f5ebdb;
  text-align: center;
  z-index: 4;
  line-height: 1.5vw;
}

.profit__text_three{
  padding: 0.8vw;
  margin: 0;
  font-weight: 500;
  font-style: normal;
  font-size: 0.8vw;
  color: #f5ebdb;
  text-align: center;
  z-index: 4;
  line-height: 1.5vw;
}



.phones{
  margin: 0;
  z-index: 1;
  position: relative;
}

.phones__img{
  margin: 0;
  position: relative;
  z-index: 2;
  width: 50vw;
  left: 2vw;
}

.phones__title{
  margin: 0;
  display: inline-block;
  color: #f5ebdb;
  font-weight: 700;
  font-size: 4vw;
  position: relative;
  z-index: 2;
  width: 40vw;
}

.phones__button{
  margin: 0;
  position: absolute;
  z-index: 2;
  bottom: 17vw;
  left: 62vw;
  width: 0vw;
}



.cooperation{
  display: flex;
  align-items: center;
  margin: 0;
  flex-direction: column;
}

.cooperation__title{
  margin: 0;
  color: #f5ebdb;
  font-weight: 600;
  font-size: 3.5vw;
  width: 76vw;
  text-align: center;
  position: relative;
}

.cooperation__menu{
  height: 500px;
  display: flex;
  align-items: center;
  justify-content: space-around;
  margin: 0;
  background: url(/images/bottom_border.png) no-repeat;
  width: 92vw;
  background-size: cover;
}

.cooperation__items{
  margin-top: -20vh;
  padding: 15vw 0 0 0;
  display: flex;
  justify-content: space-evenly;
  width: 70vw;
}

.cooperation__item{
  list-style-type: none;
  padding: 0 3.3vw 0 0;
}

.cooperation__links{
  text-decoration: none;
  color: #f5ebdb;
  font-weight: 300;
  font-style: normal;
  font-size: 1.5vw;
}

.cooperation__link{
  text-decoration: none;
  margin: 0;
  color: #f5ebdb;
  font-weight: 700;
  font-size: 4vw;
  width: 76vw;
  text-align: center;
  position: relative;
  top: 4vw;
  z-index: 2;
}

.cooperation__mixpay{
  margin: 0;
  position: relative;
  bottom: 4vw;
  width: 45vw;
}

.cooperation__button{
  margin: 0;
  position: relative;
  z-index: 2;
  bottom: 7vw;
  width: 13vw;
}

.outer-container {

}

@media screen and (max-width: 780px) {

  .lead {
    margin: 0;
    position: static;
  }

  .header__title {
    position: static;
    margin: 1rem auto 1rem auto;
  }

  .header__text {
    position: static;
    font-size: 12px;
    margin-bottom: 15px;
  }

  .header__change {
    position: static;
    margin-top: 7vh;
    justify-content: space-evenly;
    width: 100%;

    li p {
      font-size: 12px;
    }
  }

  .header__button {
    text-align: center;
    margin-top: 25px;
    position: static;

    a {
      font-size: 0.7em;
      padding: 0.5em 1em;
    }
  }

  .one__cube {
    position: absolute;
  }

  .crypto {
    margin-top: 10px;
  }

  .crypto__line {
    top: 0;
    left: 0;
  }

  .crypto__symbols {
    margin: 0 auto 0 auto;
    top: -13vw;

    img {
      padding-left: 5vw;
      padding-right: 5vw;
      margin: 0 auto 0 auto;
    }
  }

  .review {
    display: flex;
    flex-direction: column;

    .fone__text {
      width: 70vw;
      margin-top: 25px;
      margin-bottom: 25px;
    }

    .review__text_one {
      font-size: 2.8vw;
      width: 54vw;
      top: 46vw;
      left: 27vw;
    }

    .review__text_two {
      font-size: 2.7vw;
      width: 47vw;
      top: 20vw;
      left: 33vw;
    }

    .review__button {
      text-align: center;
      position: static;
      margin-bottom: 25px;

      a {
        font-size: 0.7em;
        padding: 0.5em 1em;
      }
    }

    .profit__background_one {
      width: 250px;
      height: 280px;
    }
  }

  .profit {
    margin: 0 auto 20px auto;
    display: flex;
    justify-content: space-evenly;
    flex-direction: column;
    align-items: center;

    .profit__background_one, .profit__background_two, .profit__background_three {
      margin-top: 15px;
      width: 250px;
      height: 280px;
    }

    .profit__title_one, .profit__title_two, .profit__title_three {
      font-size: 2rem;
      margin-top: 105px;
    }

    .profit__text_one, .profit__text_two, .profit__text_three, {
      padding: 0.8vw;
      margin: 0;
      line-height: 1.2rem;
      font-size: 0.6rem;
    }
  }

  .phones {
    .phones__button {
      margin: 0;
      position: absolute;
      z-index: 2;
      bottom: 10vw;
      left: 50vw;

      .button__link {
        font-size: 0.7em;
        padding: 0.5em 1em;
      }
    }
  }

  .cooperation {
    margin-top: 25px;

    .cooperation__title {
      position: static;
    }

    .cooperation__items {
      margin: 0;
      padding: 0;
    }

    .cooperation__menu {
      background: none;
      height: auto;
    }

    .cooperation__button {
      width: auto;
    }

    .button__link {
      font-size: 0.7em;
      padding: 0.5em 1em;
    }
  }

  .review__title {
    width: auto;
    left: 0;
    margin: 0 auto;
  }

}
</style>