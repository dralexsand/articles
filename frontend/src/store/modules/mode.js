export default {
    state: () => ({
        mode: '', // list, edit
        modeEntity: '', // lists, blocks, items
    }),
    getters: {
        GET_MODE(state) {
            return state.mode
        },
        GET_MODE_ENTITY(state) {
            return state.modeEntity
        },
    },
    mutations: {
        SET_MODE(state, payload) {
            state.mode = payload
        },
        SET_MODE_ENTITY(state, payload) {
            state.modeEntity = payload
        },
    },
    actions: {
        FETCH_MODE({commit}, payload) {
            commit('SET_MODE', payload)
        },
        FETCH_MODE_ENTITY({commit}, payload) {
            commit('SET_MODE_ENTITY', payload)
        },
    }
}

