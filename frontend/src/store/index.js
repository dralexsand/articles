import {createStore} from "vuex";
import createPersistedState from 'vuex-persistedstate'
import auth from "./modules/auth.js";
import posts from "./modules/posts.js";


const store = createStore({
    plugins: [
        createPersistedState()
    ],
    modules: {
        auth,
        posts
    }
})

export default store