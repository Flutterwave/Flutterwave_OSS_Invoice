import _ from 'lodash'
import {master} from '../../helpers/master'
import {LocalStorage} from 'quasar'
import { getField } from "vuex-map-fields";

export default {

    getField,

    isAuth(state) {
        let auth = _.get(state, ['is_auth'], false)
        if (auth) {
            return auth
        }
        if (LocalStorage.has(master.getStorageUserDataName())) {
            return true
        }
        return _.get(state, ['is_auth'], false)
    },

    f_name(state) {
        let f_name = _.get(state, ['user_data', 'f_name'])
        if (!f_name && LocalStorage.has(master.getStorageUserDataName())) {
            return _.get(LocalStorage.getItem(master.getStorageUserDataName()), ['f_name'], '')
        }
        return f_name
    },

    userData(state) {
        let data = _.get(state, ['user_data'])
        if (!data && LocalStorage.has(master.getStorageUserDataName())) {
            return LocalStorage.getItem(master.getStorageUserDataName()) || {}
        }
        return data
    },
}
