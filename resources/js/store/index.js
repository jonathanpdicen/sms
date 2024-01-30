import Vue from 'vue'
import Vuex from 'vuex'
import mutations from './mutations'
import actions from './actions'
import getters from './getters'

Vue.use(Vuex);

const debug = process.env.NODE_ENV !== 'production';

let default_state = {
    csrf: null,
};

export default new Vuex.Store({
    strict: debug,
    state: {
        ...default_state,
        ...window.App.state,
    },
    mutations,
    actions,
    getters,
})
