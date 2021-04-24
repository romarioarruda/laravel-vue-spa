const state = {
    listTodo: [],
    listTodoDoing: [],
    listTodoFinished: []
}
const actions = {
    setTaskDoing({commit}, payload) {
        return new Promise((resolve, reject) => {
            if (payload.id) {
                commit('M/setTaskDoing', payload)
                resolve('Tarefa iniciada!')
            } else {
                reject('ID da tarefa não foi detectado')
            }
        })
    },

    returnTaskToDo({commit}, payload) {
        return new Promise((resolve, reject) => {
            if (payload.id) {
                commit('M/returnTaskToDo', payload)
                resolve('Tarefa retornou para a lista de afazeres.')
            } else {
                reject('ID da tarefa não foi detectado')
            }
        })
    },

    setTaskFinished({commit}, payload) {
        return new Promise((resolve, reject) => {
            if (payload.id) {
                commit('M/setTaskFinished', payload)
                resolve('Tarefa finalizada!')
            } else {
                reject('ID da tarefa não foi detectado')
            }
        })
    },

    returnTaskToDoing({commit}, payload) {
        return new Promise((resolve, reject) => {
            if (payload.id) {
                commit('M/returnTaskToDoing', payload)
                resolve('Tarefa sendo feita novamente.')
            } else {
                reject('ID da tarefa não foi detectado')
            }
        })
    },

    deleteTaskFinished({commit}, payload) {
        return new Promise((resolve, reject) => {
            if (payload) {
                commit('M/deleteTaskFinished', payload)
                resolve('Tarefa deletada!')
            } else {
                reject('ID da tarefa não foi detectado.')
            }
        })
    }
}

const mutations = {
    'M/setTaskDoing' (state, payload) {
        state.listTodoDoing.unshift(payload)

        const todo = state.listTodo.filter(item => item.id !== payload.id)
        state.listTodo = todo
    },

    'M/returnTaskToDo' (state, payload) {
        state.listTodo.unshift(payload)

        const todoFinished = state.listTodoFinished.filter(item => item.id !== payload.id)
        if (todoFinished) state.listTodoFinished = todoFinished

        const todoing = state.listTodoDoing.filter(item => item.id !== payload.id)
        state.listTodoDoing = todoing
    },

    'M/setTaskFinished' (state, payload) {
        state.listTodoFinished.unshift(payload)

        const todo = state.listTodo.filter(item => item.id !== payload.id)
        if (todo) state.listTodo = todo

        const todoDoing = state.listTodoDoing.filter(item => item.id !== payload.id)
        state.listTodoDoing = todoDoing
    },

    'M/returnTaskToDoing' (state, payload) {
        state.listTodoDoing.unshift(payload)

        const todoFinished = state.listTodoFinished.filter(item => item.id !== payload.id)
        if (todoFinished) state.listTodoFinished = todoFinished
    },

    'M/deleteTaskFinished' (state, payload) {
        const todo = state.listTodoFinished.filter(item => item.id !== payload)
        state.listTodoFinished = todo
    }
}

export default {
    namespaced: true,
    state,
    mutations,
    actions
}