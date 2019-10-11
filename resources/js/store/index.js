import Vue from 'vue'
import Vuex from 'vuex'

import auth from './auth'
import error from './error'
import item from './item'
import contact from './contact'

Vue.use(Vuex)

const store = new Vuex.Store({
    modules: {
        auth,
        item,
        error,
        contact
    }
})

export default store
