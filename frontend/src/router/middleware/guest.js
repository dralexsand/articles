import {useStore} from "vuex";

export default function guest({next, store}) {

    console.log('middlware guest')
    console.log(store.getters["auth/GET_AUTHENTICATED"])

    if (!store.getters["auth/GET_AUTHENTICATED"]) {
        return next({
            name: 'login'
        })
    }

    return next()
}