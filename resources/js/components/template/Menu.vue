<template>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand">
                <img src="https://getbootstrap.com/docs/4.6/assets/brand/bootstrap-solid.svg" width="30" height="30" alt="logo">
            </a>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <button class="btn btn-link" @click="logout()">Sair</button>
                </li>
            </ul>
        </div>
    </nav>
</template>
<script>
import { mapGetters } from 'vuex'
import axios from 'axios'
export default {
    name: 'Menu',
    methods: {           
        logout () {
            this.$toasted.global.defaultInfo({ msg: 'Deslogando...' })
            axios.defaults.headers['authorization'] = this.getFullToken
            axios.post('/public/api/logout').then(resp => {
                this.destroySession
                localStorage.removeItem('vuex')
                this.$router.push({ name: 'formlogin' })
                delete axios.defaults.headers.authorization
            })
        }
    },
    computed: {
        ...mapGetters('user', [
            'destroySession',
            'getFullToken'
        ])
    }
}
</script>
<style scoped>
    .navbar-nav {
        display: flex;
        flex-direction: row;
        list-style: none;
    }
    .navbar-nav li {
        margin-right: 10px;
    }
    .nav-link {
        cursor: pointer;
    }
</style>
