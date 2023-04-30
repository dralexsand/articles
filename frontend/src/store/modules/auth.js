import axios from 'axios'
import {baseApiUrl} from "../../use/states.js";
import store from "../index.js";

export default {
    namespaced: true,
    state: {
        authenticated: false,
        error: {},
        user: {},
        token: 'my_token',
    },
    getters: {

        GET_TOKEN(state) {
            return state.token
        },
        GET_USER(state) {
            return state.user
        },
        GET_AUTHENTICATED(state) {
            return state.authenticated
        },
        GET_ERROR(state) {
            return state.error
        },
    },
    mutations: {

        SET_AUTHENTICATED(state, value) {
            state.authenticated = value
        },
        SET_TOKEN(state, payload) {
            state.token = payload
        },
        SET_USER(state, payload) {
            state.user = payload
        },
        SET_ERROR(state, payload) {
            state.error = payload
        },
    },
    actions: {

        async FETCH_USER(ctx, payload) {

            //let TOKEN = ctx.GET_TOKEN
            //let TOKEN = this
            let TOKEN = store.getters['auth/GET_TOKEN']

            let config = {
                method: 'get',
                maxBodyLength: Infinity,
                url: baseApiUrl + '/user_by_email/' + payload,
                headers: {
                    'Content-Type': 'application/json',
                    //'Authorization': `Bearer ${TOKEN}`
                }
            };

            await axios
                .request(config)
                .then(function (response) {
                    // handle success
                    console.log(response.data);
                    ctx.commit('SET_USER', response.data.data)
                    ctx.commit('SET_ERROR', {})
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                    ctx.commit('SET_AUTHENTICATED', false)
                    ctx.commit('SET_TOKEN', '')
                    ctx.commit('SET_USER', {})
                    ctx.commit('SET_ERROR', error)
                })
                .then(function () {
                    // always executed
                });
        },

        async FETCH_LOGIN(ctx, payload) {

            let config = {
                method: 'post', params: payload, maxBodyLength: Infinity, url: baseApiUrl + '/login', headers: {
                    'Content-Type': 'application/json',
                }
            };

            await axios
                .request(config)
                .then(function (response) {
                    // handle success
                    console.log(response.data);
                    ctx.commit('SET_AUTHENTICATED', true)
                    ctx.commit('SET_TOKEN', response.data.access_token)
                    ctx.commit('SET_ERROR', {})
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                    ctx.commit('SET_AUTHENTICATED', false)
                    ctx.commit('SET_TOKEN', '')
                    ctx.commit('SET_USER', {})
                    ctx.commit('SET_ERROR', error)
                })
                .then(function () {
                    // always executed
                });
        },

        async FETCH_REGISTER(ctx, payload) {

            let config = {
                method: 'post', params: payload, maxBodyLength: Infinity, url: baseApiUrl + '/register', headers: {
                    'Content-Type': 'application/json',
                }
            };

            await axios
                .request(config)
                .then(function (response) {
                    // handle success
                    console.log(response.data);

                    ctx.commit('SET_AUTHENTICATED', true)
                    ctx.commit('SET_TOKEN', response.data.access_token)
                    ctx.commit('SET_ERROR', {})
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                    ctx.commit('SET_AUTHENTICATED', false)
                    ctx.commit('SET_TOKEN', '')
                    ctx.commit('SET_USER', {})
                    ctx.commit('SET_ERROR', error)
                })
                .then(function () {
                    // always executed
                });
        },

        async FETCH_LOGOUT(ctx) {
            ctx.commit('SET_AUTHENTICATED', false)
            ctx.commit('SET_TOKEN', '')
            ctx.commit('SET_USER', {})
            ctx.commit('SET_ERROR', {})

        },
    }
}
