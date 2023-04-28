import {apiGet, apiPost, apiPut, apiDelete} from "../../use/methods.js";
import {getBaseApiUrl} from "../../use/states.js";
import axios from "axios";

export default {
    state: () => ({
        posts: {},
        //apiUrl: getBaseApiUrl(),
        apiUrl: 'http://127.0.0.1:8097/api/v1'
    }),
    getters: {
        GET_POSTS(state) {
            return state.posts
        },
    },
    mutations: {
        SET_POSTS(state, payload) {
            state.posts = payload
        },
    },
    actions: {
        async FETCH_POSTS(ctx, payload) {
            let url = ctx.state.apiUrl + '/posts';
            await axios
                .get(url)
                .then(function (response) {
                    // handle success
                    //console.log(response.data)
                    ctx.commit('SET_POSTS', response.data)
                })
                .catch(function (error) {
                    // handle error
                    console.log(error)
                })
                .then(function () {
                    // always executed
                });

            //ctx.commit('SET_POSTS', payload)
        },
    }
}

