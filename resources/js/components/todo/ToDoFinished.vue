<template>
    <div class="card mr-3 mb-4 box-todo">
        <div class="card-header">
            <h3 class="text-center">Concluídas</h3>
        </div>
        <div class="card-body">
            <dnd-zone
            vertical-search
            >
                <dnd-container
                    :dnd-model="todoListFinished"
                    dnd-id="todoListFinished"
                >
                    <template v-for="card in todoListFinished">
                        <dnd-item :dnd-model="card" :key="card.id" :dnd-id="card.id">
                            <div class="card area-card" :key="card.id">
                                <span>{{ card.name }}</span>
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
export default {
    props: [ 'todoListFinished' ],
    methods: {
        returnToDo (payload) {
            this.$store.dispatch('todo/returnTaskToDo', payload).then(resp => {
                this.$toasted.global.defaultInfo({ msg: resp })
            }).catch(msg => {
                this.$toasted.global.defaultError({ msg: resp })
            })
        },
        returnToDoing (payload) {
            this.$store.dispatch('todo/returnTaskToDoing', payload).then(resp => {
                this.$toasted.global.defaultInfo({ msg: resp })
            }).catch(msg => {
                this.$toasted.global.defaultError({ msg: resp })
            })
        },
        remove (id) {
            this.$store.dispatch('todo/deleteTaskFinished', id).then(resp => {
                this.$toasted.global.defaultSuccess({ msg: resp })
            }).catch(msg => {
                this.$toasted.global.defaultError({ msg: resp })
            })
        }
    }
}
</script>