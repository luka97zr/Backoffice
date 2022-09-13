import Index from './Index'
import router from './routes';
import VueRouter from 'vue-router'
import Vuetify from 'vuetify';
import Sidebar from './global/Aside'
import SuccessMsg from './components/SuccessMsg'
import storeDefinition from './store'
import Vuex from 'vuex'

require('./bootstrap');

window.Vue = require('vue').default;
Vue.component('Sidebar',Sidebar);
Vue.component('Success',SuccessMsg);
Vue.use(VueRouter);
Vue.use(Vuetify);
Vue.use(Vuex);

window.axios.interceptors.response.use(
  response => {
    return response;
  },
  error => {
    if(error.response.status === 401 && router.currentRoute !== '/login') {
      router.push({path: '/'});
    }
    return Promise.reject(error)
  }
)

const store = new Vuex.Store(storeDefinition);


export default new Vuetify({
  theme: { light: true },
})

const app = new Vue({
    el: '#app',
    router,
    store,
    vuetify: new Vuetify(),
    components: {
        'index': Index
    },
});
