<template>
    <div class="container mt-5 row justify-content-center">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Área de cadastro</h3>
            </div>
            <div class="card-body">
                <form class="col-12">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="name" aria-describedby="nameHelp" v-model="name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" v-model="mail">
                        <div id="emailHelp" class="form-text">Nunca iremos compartilhar seu e-mail com ninguém.</div>
                    </div>
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="senha" v-model="pass">
                    </div>
                    <button class="btn btn-primary" type="button" disabled v-if="loading">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Logando...
                    </button>
                    <button v-else @click.prevent="cadastro" :loading="loading" class="btn btn-primary">Cadastrar</button>
                    <a href="/public/#/" class="btn btn-link" style="float: right;">Área de login</a>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    name: 'formcadastro',
    data () {
        return {
            loading: false,
            name: '',
            mail: '',
            pass: ''
        }
    },
    methods: {           
        cadastro () {
            this.loading = true
            try {
                this.validate
                const payload = {
                    name: this.name,
                    email: this.mail,
                    password: this.pass
                }

                axios.post('/public/api/saveUser', payload).then(resp => {
                    this.loading = false
                    this.$router.push({ name: 'formlogin' })
                }).catch(msg => {
                    this.loading = false
                    this.$toasted.global.defaultError({ msg: msg.response.data.error })
                })
            } catch (msg) {
                this.loading = false
                return this.$toasted.global.defaultError({ msg })
            }
        }
    },
    computed: {
        validate () {
            if (!this.name.length) throw 'Preencha o campo nome'
            if (!this.mail.length) throw 'Preencha o campo e-mail'
            if (!this.mail.match(/\w+@\w+/igs)) throw 'Digite um e-mail válido'
            if (!this.pass.length) throw 'Preencha o campo senha'
        }
    }
}
</script>
