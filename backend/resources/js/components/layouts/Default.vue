<template>
  <header class="header">
    <div class="header__logo">
      <a class="logo__link" href="/">
        <img src="/images/mixpieloho.png" alt="логотип" class="header__img">
      </a>
    </div>
    <nav class="header__menu">
      <ul class="header__items">
        <li v-show="!$store.state.auth.authenticated" class="header__item">
          <a class="header__link" href="/login">Вход</a>
        </li>
        <li v-show="!$store.state.auth.authenticated" class="header__item">
          <a class="header__link" href="/register">Регистрация</a>
        </li>
        <li v-show="$store.state.auth.authenticated" class="header__item">
          <a class="header__link" href="/profile">Кабинет</a>
        </li>
        <li v-show="$store.state.auth.authenticated" class="header__item">
          <a class="header__link" href="#" @click="logout">Выход</a>
        </li>
        <li class="header__item">
          <a class="header__link" href="/exchange">Обменять</a>
        </li>
        <li class="header__item">
          <a class="header__link" href="#">Контакты</a>
        </li>
      </ul>
    </nav>
  </header>
  <router-view></router-view>
  <footer class="footer">
    <div class="footer__logo">
      <a class="logo__link" href="#">
        <img src="/images/mixpieloho.png" alt="логотип" class="footer__img">
      </a>
      <p class="footer__copyright">2023 Mix pay.</p>
      <div class="footer__circles">
        <div class="footer__circle"></div>
        <div class="footer__circle"></div>
      </div>
    </div>
    <nav class="footer__menu">
      <ul class="footer__items">
        <li class="footer__item">
          <a class="footer__link" href="#">Обменять</a>
        </li>
        <li class="footer__item">
          <a class="footer__link" href="#">Проект</a>
        </li>
        <li class="footer__item">
          <a class="footer__link" href="#">Команда</a>
        </li>
        <li class="footer__item">
          <a class="footer__link" href="#">Контакты</a>
        </li>
      </ul>
    </nav>
  </footer>
</template>

<script>
import {mapActions} from 'vuex'

export default {
  name: "default-layout",
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
        this.$router.push({name: "main"})
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

.page{
  background-color: #130a01;
  max-width: 100%;
  height: 100%;
  margin: 0 auto;
  font-family: "Montserrat";
}

.footer{
  width: 100%;

  margin: 0;
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
}

.footer__logo{
  margin: 0;
  padding-left: 5vw;
  display: flex;
  align-items: flex-start;
  flex-direction: column;
}

.footer__link{
  text-decoration: none;
  color: #f5ebdb;
  font-weight: 200;
  font-style: normal;
  padding-right: 3vw;
  font-size: 1.2vw;
}

.footer__img{
  width: 9vw;
}

.footer__items{
  margin: 0;
  display: flex;
  justify-content: center;
  padding-right: 3vw;
}

.footer__item{
  list-style-type: none;
  padding-left: 1.5vw;
}

.footer__copyright{
  margin: 0;
  color: #f5ebdb;
  padding-top: 1.6vw;
  font-weight: 100;
}

.footer__circles{
  display: flex;
  padding-top: 1vw;
}

.footer__circle{
  background: #e76912;
  border-radius: 50%;
  height: 2em;
  width: 2em;
  margin-right: 0.6vw;
}
.header{
  width: 100%;
  padding-top: 1.2vw;
  padding-bottom: 10vw;
  margin: 0;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.header__logo{
  margin: 0;
  padding-left: 7.5vw;
  padding-top: 1.5vw;
  display: flex;
  align-items: center;
  position: relative;
  z-index: 2;
}

.header__img{
  width: 9vw;
}

.header__link{
  text-decoration: none;
  color: #f5ebdb;
  font-weight: 300;
  font-style: normal;
  padding-right: 1.5vw;
  padding-left: 1.5vw;
  font-size: 1.2vw;
}


.header__link:hover{
  background-color: #e76912;
  border-radius: 15px;
  padding-right: 1.5vw;
  padding-left: 1.5vw;
  box-sizing: border-box;
}

.header__menu{
  padding-top: 1.5vw;
  position: relative;
  z-index: 2;
}

.header__items{
  margin: 0;
  display: flex;
  justify-content: center;
  padding-right: 3vw;
}

.header__item{
  list-style-type: none;
}

.outer-container {
  margin: 0;
  background: url(/images/sheets_fone_1.png) no-repeat;
  background-size: cover;
  position: relative;
  z-index: 1;
  display: flex;
  height: 100vh;
  flex-direction: column;
  justify-content: space-between;
  align-items: stretch;
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
}

</style>