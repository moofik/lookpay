import axios from 'axios'
import router from '@/router'

export default {
    namespaced: true,
    state: {
        authenticated: false,
        user: {}
    },
    getters: {
        authenticated(state) {
            return state.authenticated
        },
        user(state) {
            return state.user
        }
    },
    mutations: {
        SET_AUTHENTICATED(state, value) {
            state.authenticated = value
        },
        SET_USER(state, value) {
            state.user = value
        }
    },
    actions: {
        login({commit}, data) {
            axios.defaults.headers.common.Authorization = `${data.token_type} ${data.access_token}`
            window.localStorage.setItem('token', data.access_token);
            window.localStorage.setItem('tokenType', data.token_type);

            return axios.get('/api/user').then(({data}) => {
                commit('SET_USER', data)
                commit('SET_AUTHENTICATED', true)
                router.push({name: 'main'})
            }).catch(({response: {data}}) => {
                commit('SET_USER', {})
                commit('SET_AUTHENTICATED', false)
            })
        },
        loginWithoutRedirect({commit}, data) {
            axios.defaults.headers.common.Authorization = `${data.token_type} ${data.access_token}`
            window.localStorage.setItem('token', data.access_token);
            window.localStorage.setItem('tokenType', data.token_type);

            return axios.get('/api/user').then(({data}) => {
                commit('SET_USER', data)
                commit('SET_AUTHENTICATED', true)
            }).catch(({response: {data}}) => {
                commit('SET_USER', {})
                commit('SET_AUTHENTICATED', false)
            })
        },
        logout({commit}) {
            commit('SET_USER', {})
            commit('SET_AUTHENTICATED', false)
            router.push({name: 'main'})
        }
    }
}