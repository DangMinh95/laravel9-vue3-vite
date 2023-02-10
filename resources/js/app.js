import './bootstrap';
import {createApp} from 'vue'
import router from './router'
import store from './store'
import App from './App.vue'
import axios from 'axios'
import VueAxios from 'vue-axios'

const Vue = createApp(App)
Vue.config.devtools = true
Vue.config.productionTip = false;
Vue.use(store).use(router).use(VueAxios, axios).mount("#app")

