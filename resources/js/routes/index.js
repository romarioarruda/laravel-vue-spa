import Vue from 'vue'
import VueRouter from 'vue-router'

import TodoList from '../components/ToDoListComponent'
import FormLogin from '../components/FormLoginComponent'
import FormCadastro from '../components/FormCadastroComponent'


Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        component: FormLogin,
        name: 'formlogin',
        props: true
    },
    {
        path: '/cadastro',
        component: FormCadastro,
        name: 'formcadastro',
        props: true
    },
    {
        path: '/todo',
        component: TodoList,
        name: 'todo',
        props: true
    }
]

const router = new VueRouter({
    mode: 'hash',
    base: 'http://localhost:8081',
    routes
})

export default router