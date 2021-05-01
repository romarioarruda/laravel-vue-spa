<template>
    <div class="card mr-3 mb-4 box-todo">
        <div class="card-header">
            <h3 class="text-center">Fazendo</h3>
        </div>
        <div class="card-body">
            <Loading v-if="!todoListDoing.length" />
            <dnd-zone v-else vertical-search>
                <dnd-container
                    :dnd-model="todoListDoing"
                    dnd-id="todoListDoing"
                >
                    <template v-for="card in todoListDoing">
                        <dnd-item :dnd-model="card" :key="card.id" :dnd-id="card.id">
                            <div class="card area-card" :key="card.id">
                                <span>{{ card.titulo }}</span>
                                <div class="area-buttons">
                                    <button @click="returnToDo(card)" class="btn btn-outline-danger btn-sm">A fazer</button>
                                    <button @click="finished(card)" class="btn btn-outline-success btn-sm">Concluir</button>
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
    props: [ 'todoListDoing' ],
    components: { Loading },
    methods: {
        returnToDo (payload) {
            this.saveOnToDoDataBase(payload)
            this.removeOnTodoingDataBase(payload)

            this.$store.dispatch('todo/returnTaskToDo', payload).then(resp => {
                this.$toasted.global.defaultInfo({ msg: resp })
            }).catch(msg => {
                this.$toasted.global.defaultError({ msg: resp })
            })
        },

        saveOnToDoDataBase (payload) {
            axios.defaults.headers['authorization'] = this.getFullToken
            axios.post('/public/api/todo/save', payload)
        },

        finished (payload) {
            this.saveOnToDoFinishedDataBase(payload)
            this.removeOnTodoingDataBase(payload)

            this.$store.dispatch('todo/setTaskFinished', payload).then(resp => {
                this.$toasted.global.defaultSuccess({ msg: resp })
            }).catch(msg => {
                this.$toasted.global.defaultError({ msg: resp })
            })
        },

        saveOnToDoFinishedDataBase (payload) {
            axios.defaults.headers['authorization'] = this.getFullToken
            axios.post('/public/api/todofinished/save', payload)
        },

        removeOnTodoingDataBase (payload) {
            axios.defaults.headers['authorization'] = this.getFullToken
            axios.delete(`/public/api/todoing/${payload.id}`)
        },
    },

    computed: {
        ...mapGetters('user', [
            'getFullToken'
        ])
    }
}
</script>