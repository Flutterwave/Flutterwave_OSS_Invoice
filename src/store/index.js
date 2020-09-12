import Vue from 'vue'
import Vuex from 'vuex'

import auth from './auth'
import clients from './clients'
import invoices from './invoices'

Vue.use(Vuex)

/*
 * If not building with SSR mode, you can
 * directly export the Store instantiation
 */

export default function (/* { ssrContext } */) {
    return new Vuex.Store({
        modules: {
            auth, clients, invoices
        },

        // enable strict mode (adds overhead!)
        // for dev mode only
        strict: process.env.DEV
    })
}
