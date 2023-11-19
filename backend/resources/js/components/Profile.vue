<template>
  <main class="main-register">
    <div class="main-exchange-table">
      <h1 class="table_h1">Ваши обмены</h1>
      <table class="table_container">
        <tr class="table_row">
          <th class="table_header">ID</th>
          <th class="table_header">Валюта</th>
          <th class="table_header">Количество</th>
          <th class="table_header">Статус</th>
        </tr>
        <tr v-for="item in payment_list" :key="item.id">
          <td class="table_data">{{item.id}}</td>
          <td class="table_data">{{item.currency_to}}</td>
          <td class="table_data">{{item.payment_amount}}</td>
          <td class="table_data">{{item.status}}</td>
        </tr>
      </table>
    </div>
  </main>
</template>

<script>
import {mapActions} from 'vuex'

export default {
  name: "profile",
  data() {
    return {
      user: this.$store.state.auth.user,
      payment_list: null
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
    },
    async payments() {
      await axios.get('/api/payment-list').then(({data}) => {
        console.log(data)
        this.payment_list = data
      })
    }
  },
  computed: {
    authenticated: function () {
      return this.$store.state.auth.authenticated;
    }
  },
  created() {
    if (!this.authenticated) {
      this.$router.push({name: "login"})
    }
    this.payments();
  }
}
</script>

<style lang="scss">

.content{
  margin: 0;
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

.main-register {
  height: 100%;

  .main-exchange-table {
    text-align: center;
    height: auto;
    min-height: 350px;
    width: 60%;
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

    h1.table_h1 {
      font-size: 1.5em;
      margin-bottom: 20px;
      color: white;
    }

    .table_container {
      width: 100%;
    }

    .table_data, .table_header {
      margin: 10px;
      color: wheat;
      padding: 10px;
    }

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

</style>