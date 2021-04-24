<template>
    <div class="card mr-3 mb-4 box-todo">
        <div class="card-header">
            <h3 class="text-center">Fazendo</h3>
        </div>
        <div class="card-body">
            <dnd-zone
            vertical-search
            >
                <dnd-container
                    :dnd-model="todoListDoing"
                    dnd-id="todoListDoing"
                >
                    <template v-for="card in todoListDoing">
                        <dnd-item :dnd-model="card" :key="card.id" :dnd-id="card.id">
                            <div class="card area-card" :key="card.id">
                                <span>{{ card.name }}</span>
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
export default {
    props: [ 'todoListDoing' ],
    methods: {
        returnToDo (payload) {
            this.$store.dispatch('todo/returnTaskToDo', payload).then(resp => {
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
    }
}
</script>