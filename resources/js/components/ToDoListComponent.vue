<template>
    <div>
        <Menu />
        <div class="conteudo-listas">
            <to-do :todoList="todo.listTodo"/>
            <to-do-doing :todoListDoing="todo.listTodoDoing"/>
            <to-do-finished :todoListFinished="todo.listTodoFinished"/>
        </div>
    </div>
</template>

<script>
import { mapState, mapActions, mapGetters } from 'vuex'
import axios from 'axios'
import Menu from './template/Menu'
import ToDo from './todo/ToDo'
import ToDoDoing from './todo/ToDoDoing'
import ToDoFinished from './todo/ToDoFinished'
export default {
    name: 'todo',
    components: {
        Menu,
        ToDo,
        ToDoDoing,
        ToDoFinished
    },
    mounted () {
        if (!this.user.accessToken.access_token) {
            this.$router.push({ name: 'formlogin' })
        }

        this.cronRefreshToken
        this.getTodoByUser()
    },

    methods: {
        getTodoByUser () {
            axios.defaults.headers['authorization'] = this.getFullToken
            axios.get(`/public/api/todo/user/${this.user.userData.id}`).then(resp => {
                this.$store.dispatch('todo/definingToDoList', resp.data)
            }).catch(msg => {
                this.$toasted.global.defaultError({
                    msg: 'Erro: lista de tarefas a fazer não pode ser carregada/atualizada.'
                })
            })
        }
    },

    computed: {
        ...mapState({
            todo: state => state.todo,
            user: state => state.user
        }),
        ...mapActions('user', [
            'cronRefreshToken',
            'destroySession'
        ]),
        ...mapGetters('user', [
            'getFullToken'
        ])
    }
}
</script>
<style>
    .conteudo-listas {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        margin-top: 3rem;
    }
    .card-body {
        cursor: pointer;
        z-index: 1;
    }
    * {
        user-select: none;
    }
    .box-todo {
        width: 300px;
    }
    .area-card {
        height: 100px;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 8px;
        box-shadow: 0px 0px 3px #000;
        padding: 5px;
    }
</style>