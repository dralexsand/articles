import {createStore} from "vuex";

import mode from "./modules/mode.js";

const store = createStore({
    modules: {
        mode,
    }
})

export default store