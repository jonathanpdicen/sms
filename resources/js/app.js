
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import router from './router'
import store from './store'

require('./bootstrap');
require('./filters');
// require('./forms/bootstrap');

window.Vue = require('vue');

const App = require('@/components/App').default;

const app = new Vue({
    components: {App},
    template: "<App/>",
    router,
    store,
}).$mount('#app');
