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