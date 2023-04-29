import {createApp} from 'vue'
//import './style.css'
import './main.css'
import App from './App.vue'
import router from "./router";
import store from "./store";
import moment from "moment";

const app = createApp(App)

app.config.globalProperties.$filters = {
    timeAgo(date) {
        return moment(date).fromNow()
    },
}

app.use(router).use(store)

app.mount('#app')
