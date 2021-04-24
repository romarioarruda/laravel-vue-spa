import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'

import user from './modules/user'
import todo from './modules/todo'

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        user,
        todo
    },
    plugins: [
        createPersistedState()
    ]
})
