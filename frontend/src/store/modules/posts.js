import axios from 'axios'
import router from "../../router/index.js";
import {baseApiUrl} from "../../use/states.js";
import {ref} from "vue";
import store from "../index.js";

export default {
    namespaced: true,
    state: {
        authors: [],
        authors_filtered: {},
        posts: {},
        post: {},
        data_error: {}
    },
    getters: {
        GET_AUTHORS(state) {
            return state.authors
        },
        GET_AUTHORS_FILTERED(state) {
            return state.authors_filtered
        },
        GET_POSTS(state) {
            return state.posts
        },
        GET_POST(state) {
            return state.post
        },
        GET_DATA_ERROR(state) {
            return state.data_error
        },
    },
    mutations: {
        SET_AUTHORS(state, payload) {
            state.authors = payload
        },
        SET_AUTHORS_FILTERED(state, payload) {
            state.authors_filtered = payload
        },
        SET_POSTS(state, payload) {
            state.posts = payload
        },
        SET_POST(state, payload) {
            state.post = payload
        },
        SET_DATA_ERROR(state, payload) {
            state.data_error = payload
        },
    },
    actions: {
        async CREATE_POST(ctx, payload) {

            let TOKEN = store.getters['auth/GET_TOKEN']

            let config = {
                method: 'post',
                data: payload,
                maxBodyLength: Infinity,
                url: baseApiUrl + '/posts',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${TOKEN}`
                }
            };

            await axios
                .request(config)
                .then(function (response) {
                    // handle success
                    //console.log(response.data);
                    ctx.commit('SET_POST', response.data)
                    ctx.commit('SET_DATA_ERROR', {})
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                    ctx.commit('SET_DATA_ERROR', error)
                })
                .then(function () {
                    // always executed
                });
        },

        async UPDATE_POST(ctx, payload) {

            console.log(payload)

            let TOKEN = store.getters['auth/GET_TOKEN']

            let config = {
                method: 'put',
                data: payload,
                maxBodyLength: Infinity,
                url: baseApiUrl + '/posts/' + payload.id,
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${TOKEN}`
                }
            };

            console.log(config.url)


            await axios
                .request(config)
                .then(function (response) {
                    // handle success
                    //console.log(response.data);
                    ctx.commit('SET_POST', response.data)
                    ctx.commit('SET_DATA_ERROR', {})
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                    ctx.commit('SET_DATA_ERROR', error)
                })
                .then(function () {
                    // always executed
                });
        },

        async FETCH_POST(ctx, payload, callback = null) {

            let TOKEN = store.getters['auth/GET_TOKEN']

            let config = {
                method: 'get',
                maxBodyLength: Infinity,
                url: baseApiUrl + '/posts/' + payload,
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${TOKEN}`
                }
            };

            await axios
                .request(config)
                .then(function (response) {
                    // handle success
                    //console.log(response.data);
                    if (callback !== null) {
                        callback(response.data)
                    }
                    ctx.commit('SET_POST', response.data)
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                    if (callback !== null) {
                        callback(error)
                    }
                })
                .then(function () {
                    // always executed
                });
        },

        async FETCH_POSTS(ctx, payload) {

            let TOKEN = store.getters['auth/GET_TOKEN']

            let config = {
                method: 'get',
                maxBodyLength: Infinity,
                url: baseApiUrl + '/posts' + payload,
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${TOKEN}`
                }
            };

            await axios
                .request(config)
                .then(function (response) {
                    // handle success
                    //console.log(response.data);
                    ctx.commit('SET_POSTS', response.data)
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                    ctx.commit('SET_DATA_ERROR', error)
                })
                .then(function () {
                    // always executed
                });
        },

        async FETCH_AUTHORS(ctx, payload) {

            let TOKEN = store.getters['auth/GET_TOKEN']

            let config = {
                method: 'get',
                //params: payload,
                maxBodyLength: Infinity,
                url: baseApiUrl + '/authors_list' + payload,
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${TOKEN}`
                }
            };

            await axios
                .request(config)
                .then(function (response) {
                    // handle success
                    //console.log(response.data);
                    if (payload !== '') {
                        ctx.commit('SET_AUTHORS_FILTERED', response.data.data)
                    } else {
                        ctx.commit('SET_AUTHORS', response.data.data)
                    }

                    ctx.commit('SET_DATA_ERROR', {})
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                    ctx.commit('SET_DATA_ERROR', error)
                })
                .then(function () {
                    // always executed
                });
        },

    }
}
