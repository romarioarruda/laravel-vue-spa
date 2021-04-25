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
import { mapState } from 'vuex'
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
        console.log(this.user)
        if (!this.user.accessToken.access_token) {
            this.$router.push({ name: 'formlogin' })
        }
    },
    computed: {
        ...mapState({
            todo: state => state.todo,
            user: state => state.user
        })
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