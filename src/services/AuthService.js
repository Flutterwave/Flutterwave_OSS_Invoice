import {master} from '../helpers/master'
import axios from 'axios'

const AuthService = {
    getCookie() {
        return axios.get(master.web('sanctum/csrf-cookie'))
    },
    registerUser(form) {
        return axios.post(master.api('auth/user/register'), form)
    },
    login(form) {
        return axios.post(master.api('auth/login'), form)
    },
    logout() {
        return axios.post(master.api('auth/logout'))
    },
    getAuthUser() {
        return axios.get(master.api('auth/user'))
    }
}

export {AuthService}
