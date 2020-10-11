import {master} from '../helpers/master'
import axios from 'axios'

const UtilService = {
    fetchCountries() {
        return axios.get(master.api('utils/fetchCountries'))
    },
    fetchCurrencies() {
        return axios.get(master.api('utils/fetchCurrencies'))
    },
    fetchCustomers() {
        return axios.get(master.api('utils/fetchCustomers'))
    },
    fetchInvoiceFormOptions() {
        return axios.get(master.api('invoice/fetchInvoiceFormOptions'))
    },
}

export {UtilService}
