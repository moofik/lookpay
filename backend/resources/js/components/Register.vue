<template>
  <main class="main-register">
    <form class="main-register-form" @submit.prevent="register">
      <h1>Регистрация</h1>
      <input required class="register-text-input" type="email" placeholder="Электронная почта" v-model.trim="user.email"/>
      <input required class="register-text-input" type="text" placeholder="Пароль" v-model.trim="user.password"/>
      <input class="register-button glow" type="submit" value="Зарегестрироваться">
    </form>
  </main>
</template>

<script>
import {mapActions} from 'vuex'

export default {
  name: 'register',
  data() {
    return {
      user: {
        email: "",
        password: "",
      },
      validationErrors: {},
      processing: false
    }
  },
  methods: {
    ...mapActions({
      signIn: 'auth/loginWithoutRedirect',
      signOut: "auth/logout"
    }),
    async register() {
      this.processing = true
      await axios.get('/sanctum/csrf-cookie')

      const config = {
        headers: {'content-type': 'multipart/form-data'}
      }

      let formData = new FormData();
      formData.append('email', this.user.email);
      formData.append('password', this.user.password);

      await axios.post('/api/register', formData, config).then(({data}) => {
        this.validationErrors = {}

        if (!this.$store.state.auth.authenticated) {
          this.signIn(data)
          this.$router.push({name: "main"})
        }
      }).catch((data) => {
        console.log(data)
        if (data.response.status === 422) {
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
  }
}
</script>

<style lang="scss">
.main-register {
  height: 100%;

  .main-register-form {
    width: 50%;
    padding: 40px;
    border-radius: 25px;
    display: flex;
    flex-direction: column;
    align-content: flex-end;
    justify-content: space-evenly;
    align-items: center;
    flex-wrap: nowrap;
    border: 1px solid #873b06;
    background: #130a01;
    margin: 0 auto 100px auto;

    h1 {
      color: #e76912;
    }

    .register-text-input {
      margin-top: 2vh;
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


.glow {
  box-shadow:  0 0 10px 10px #e76912,
  0 0 10px 15px #e75212;

  &:hover {
    box-shadow:  0 0 10px 10px #e75212,
    0 0 10px 10px #e85a41;
  }
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

    .main-register-form {
      margin-top: 30px;
      width: 80%;


      h1 {
        color: #e76912;
      }

      .register-text-input {
        padding: 1.1em;
      }

      .register-button {
        padding: 0.5rem;
      }
    }
  }
}

</style>