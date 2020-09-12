import axios from 'axios'
import _ from 'lodash'
import {master} from '../helpers/master'
import {Cookies, LocalStorage, Notify} from 'quasar'

export default async ({Vue, app, ssrContext, store, router}) => {
    const cookies = process.env.SERVER
        ? Cookies.parseSSR(ssrContext)
        : Cookies
    // Global axios defaults

    // let token = LocalStorage.getItem(master.getAuthTokenName())
    axios.defaults.baseURL = master.api();
    axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
    axios.defaults.withCredentials = true
    axios.defaults.headers.common['Accept-Language'] = cookies.get(master.getLangCookieName())
    // if (!_.isEmpty(token)) {
    //     axios.defaults.headers.common['Authorization'] = `Bearer ${token}`
    // }
    // Add a request interceptor
    axios.interceptors.request.use((config) => {
        // Do something before request is sent
        return config
    }, (error) => {
        // Do something with request error
        return Promise.reject(error)
    })
    // Add a response interceptor
    axios.interceptors.response.use((response) => {
        // Do something with response data
        return response
    }, (error) => {
        if (error.response) {
            switch (error.response.status) {
                case 422:
                    // form error
                    break

                case 404:
                    console.log(error.response)
                    Notify.create({
                        message: 'Resource not found',
                        color: 'negative'
                    })
                    break

                case 405:
                    console.log(error.response)
                    Notify.create({
                        message: 'Method not allowed',
                        color: 'negative'
                    })
                    break

                case 403:
                    console.log(error.response)
                    Notify.create({
                        message: 'Unauthorized action',
                        color: 'negative'
                    })
                    break

                case 419:
                    console.log(error.response)
                    Notify.create({
                        message: 'Invalid token',
                        color: 'negative'
                    })
                    break

                case 500:
                    console.log(error.response)
                    Notify.create({
                        message: 'Internal Server Error',
                        color: 'negative'
                    })
                    break

                case 401:
                    console.log(error.response)
                    let message = _.get(error, ['response', 'data', 'message'], '')
                    if (message === 'Unauthenticated') {
                        Notify.create({
                            message: 'Your session has expired',
                            color: 'orange'
                        })
                        store.dispatch('auth/basicLogout', router)
                    }
                    break

                default:
                    console.log(error.response)
                    Notify.create({
                        message: 'An unexpected error occurred',
                        color: 'negative'
                    })
                    break
            }
        } else {
            console.log(error.response)
            Notify.create({
                message: 'Server Error',
                color: 'negative'
            })
        }
        // Do something with response error
        return Promise.reject(error)
    })
    Vue.prototype.$axios = axios
}

export {axios}
