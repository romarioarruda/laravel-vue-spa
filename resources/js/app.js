require('./bootstrap')

import './utils/toasted'
import store from './store/index'
import VueDndZone from 'vue-dnd-zone'
import Vue from 'vue'
import router from './routes/index'
import 'vue-dnd-zone/vue-dnd-zone.css'

Vue.use(VueDndZone)

new Vue({
    router,
    store
}).$mount('#app')