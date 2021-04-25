import axios from 'axios'

const state = {
    userData: {},
    accessToken: {}
}
const actions = {
    setAccessToken ({commit}, payload) {
        return new Promise((resolve, reject) => {
            if (payload.access_token) {
                commit('M/setAccessToken', payload)
                resolve()
            } else {
                reject()
            }
        })
    },

    setUserData ({commit}, payload) {
        return new Promise((resolve, reject) => {
            if (payload.id) {
                commit('M/setUserData', payload)
                resolve()
            } else {
                reject()
            }
        })
    },

    cronRefreshToken ({commit, state}) {
        const time = 60 * 1000 * 60 // uma hora
        let timer = setInterval(() => {
            if (typeof state.accessToken.access_token === 'undefined') {
                clearInterval(timer)
            }
            console.log('cronRefreshToken job rodando...')
            axios.defaults.headers['authorization'] = state.accessToken.token_type +' '+ state.accessToken.access_token
            axios.post('/public/api/refresh').then(resp => {
                if (resp.data.access_token) {
                    commit('M/setAccessToken', resp.data)
                }
            })
        }, time)
    }
}

const mutations = {
    'M/setAccessToken' (state, payload) {
        state.accessToken = payload
    },

    'M/setUserData' (state, payload) {
        state.userData = payload
    }
}

const getters = {
    getFullToken (state) {
        return state.accessToken.token_type +' '+ state.accessToken.access_token
    },

    destroySession (state) {
        state.accessToken = {}
        state.userData = {}
    }
}

export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters
}