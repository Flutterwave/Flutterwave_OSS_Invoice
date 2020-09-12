import Vue from 'vue'
import VueRouter from 'vue-router'

import routes from './routes'
import { LocalStorage } from "quasar";
import { master } from "../helpers/master";

Vue.use(VueRouter)

/*
 * If not building with SSR mode, you can
 * directly export the Router instantiation
 */

export default function (/* { store, ssrContext } */) {
    const Router = new VueRouter({
        scrollBehavior: () => ({x: 0, y: 0}),
        routes,

        // Leave these as is and change from app.conf.js instead!
        // app.conf.js -> build -> vueRouterMode
        // app.conf.js -> build -> publicPath
        mode: process.env.VUE_ROUTER_MODE,
        base: process.env.VUE_ROUTER_BASE
    })

    Router.beforeEach((to, from, next) => {

        if (to.matched.some(record => record.meta.requiresAuth)) {
            if (LocalStorage.getItem(master.getStorageUserDataName()) !== null) { // logged in
                // console.log("logged in");
                next();
            } else { // not authenticated
                // console.log("not authenticated 1, " + to.fullPath);
                next({
                    path: "/login",
                    query: { redirect: to.fullPath }
                });
            }
        } else if (to.matched.some(record => !record.meta.requiresAuth)) {
            if (LocalStorage.getItem(master.getStorageUserDataName()) !== null) {
                // console.log("logged in, redirect", from.fullPath);
                // when url is changed manually, a new context is created with from.fullPath == '/'
                next({path: '/invoices'});
            } else {
                // console.log("not authenticated 2");
                next();
            }
        } else {
            // console.log("not authenticated, fallback");
            next();
        }

    });

    return Router
}
