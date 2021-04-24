const state = {
    userData: {}
}
const actions = {
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
    'M/setUserData' (state, payload) {
        state.userData = payload
    }
}

const getters = {
    destroySession (state) {
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