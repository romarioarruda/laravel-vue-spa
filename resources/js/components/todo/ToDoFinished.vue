<template>
    <div class="card mr-3 mb-4 box-todo">
        <div class="card-header">
            <h3 class="text-center">Concluídas</h3>
        </div>
        <div class="card-body">
            <Loading v-if="loading" />
            <dnd-zone v-else vertical-search>
                <dnd-container
                    :dnd-model="todoListFinished"
                    dnd-id="todoListFinished"
                >
                    <template v-for="card in todoListFinished">
                        <dnd-item :dnd-model="card" :key="card.id" :dnd-id="card.id">
                            <div class="card area-card" :key="card.id">
                                <span>{{ card.titulo }}</span>
                                <div class="area-buttons">
                                    <button @click="returnToDoing(card)" class="btn btn-outline-info btn-sm">Refazer</button>
                                    <button @click="returnToDo(card)" class="btn btn-outline-primary btn-sm">A fazer</button>
                                    <button @click="remove(card.id)" class="btn btn-outline-danger btn-sm">Deletar</button>
                                </div>
                            </div>
                        </dnd-item>
                    </template>
                </dnd-container>
            </dnd-zone>
        </div>
    </div>
</template>

<script>
import { mapState, mapActions, mapGetters } from 'vuex'
import axios from 'axios'
import Loading from '../template/Loading'
export default {
    props: [ 'todoListFinished' ],
    components: { Loading },
    methods: {
        returnToDo (payload) {
            this.saveOnToDoDataBase(payload)
            this.removeOnTodoFinishedDataBase(payload)

            this.$store.dispatch('todo/returnTaskToDo', payload).then(resp => {
                this.$toasted.global.defaultInfo({ msg: resp })
            }).catch(msg => {
                this.$toasted.global.defaultError({ msg: resp })
            })
        },
        returnToDoing (payload) {
            this.saveOnToDoingDataBase(payload)
            this.removeOnTodoFinishedDataBase(payload)

            this.$store.dispatch('todo/returnTaskToDoing', payload).then(resp => {
                this.$toasted.global.defaultInfo({ msg: resp })
            }).catch(msg => {
                this.$toasted.global.defaultError({ msg: resp })
            })
        },
        remove (id) {
            this.removeOnTodoFinishedDataBase({ id })

            this.$store.dispatch('todo/deleteTaskFinished', id).then(resp => {
                this.$toasted.global.defaultSuccess({ msg: resp })
            }).catch(msg => {
                this.$toasted.global.defaultError({ msg: resp })
            })
        },

        saveOnToDoDataBase (payload) {
            axios.defaults.headers['authorization'] = this.getFullToken
            axios.post('/public/api/todo/save', payload)
        },

        saveOnToDoingDataBase (payload) {
            axios.defaults.headers['authorization'] = this.getFullToken
            axios.post('/public/api/todoing/save', payload)
        },

        removeOnTodoFinishedDataBase (payload) {
            axios.defaults.headers['authorization'] = this.getFullToken
            axios.delete(`/public/api/todofinished/${payload.id}`)
        },
    },

    computed: {
        loading () {
            return !this.todoListFinished.length
        },

        ...mapGetters('user', [
            'getFullToken'
        ])
    }
}
</script>