export default {
    state: () => ({
        users: {}
    }),
    getters: {
        GET_USERS(state) {
            return state.users
        },
    },
    mutations: {
        SET_USERS(state, payload) {
            state.users = payload
        },
    },
    actions: {
        FETCH_USERS({commit}, payload) {
            commit('SET_USERS', payload)
        },
    }
}

