<template>
    <div class="card mr-3 mb-4 box-todo">
        <div class="card-header">
            <h3 class="text-center">A Fazer</h3>
        </div>
        <div class="card-body">
            <Loading v-if="loading" />
            <dnd-zone v-else vertical-search>
                <dnd-container
                    :dnd-model="todoList"
                    dnd-id="todoList"
                >
                    <template v-for="card in todoList">
                        <dnd-item :dnd-model="card" :key="card.id" :dnd-id="card.id">
                            <div class="card area-card" :key="card.id">
                                <span>{{ card.titulo }}</span>
                                <div class="area-buttons">
                                    <button @click="doing(card)" class="btn btn-outline-secondary btn-sm">Fazer</button>
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
import Loading from '../template/Loading'
export default {
    props: [ 'todoList' ],
    components: { Loading },
    methods: {
        doing (payload) {
            this.$store.dispatch('todo/setTaskDoing', payload).then(resp => {
                this.$toasted.global.defaultInfo({ msg: resp })
            }).catch(msg => {
                this.$toasted.global.defaultError({ msg: resp })
            })
        },
        finished (payload) {
            this.$store.dispatch('todo/setTaskFinished', payload).then(resp => {
                this.$toasted.global.defaultSuccess({ msg: resp })
            }).catch(msg => {
                this.$toasted.global.defaultError({ msg: resp })
            })
        }
    },

    computed: {
        loading () {
            return !this.todoList.length
        }
    }
}
</script>