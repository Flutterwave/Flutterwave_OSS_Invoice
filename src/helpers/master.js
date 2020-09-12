import _ from 'lodash'
import {Notify} from 'quasar'

const master = {
    getAuthTokenName() {
        return process.env.AUTH_TOKEN_NAME
    },
    getStorageUserDataName() {
        return 'user_data'
    },
    getLangCookieName() {
        return process.env.LANG_COOKIE_NAME
    },
    web(url = '') {
        const web = process.env.WEB_URL
        return `${web}/${url}`
    },
    invoices(url = '') {
        const invoices = process.env.INVOICES_URL
        return `${invoices}/${url}`
    },
    /**
     * Option to obtain the base url of the api
     *
     * @param url
     * @returns {string}
     */
    api(url = '') {
        const api = process.env.API_URL
        return `${api}/${url}`
    },
    /**
     * Gets the set of errors (error 422), if not, returns false.
     *
     * @param errors
     * @returns {*}
     */
    hasErrors(errors) {
        let status = _.get(errors, ['response', 'status'])
        if (status === 422) {
            return _.get(errors, ['response', 'data', 'errors'], false)
        } else if (status === 401) {
            let message = _.get(errors, ['response', 'data', 'error'])
            if (message === 'invalid_credentials') {
                return {
                    'type': 'auth',
                    'errors': _.get(errors, ['response', 'data', 'errors'], false)
                }
            }
        }
        return false
    },
    hasRule(element, rule) {
        let ruler = _.get(element, ['failedRules', rule])
        return !_.isEmpty(ruler)
    },

    /**
     * Take the list of errors issued by the server (or custom) and attach it to the VeeValidate errors
     *
     * @param {object} observer - observer de veevalidate
     * @param {object} errors - lista de errores (parseada por hasErrors) del servidor
     */
    setErrors(observer, errors) {
        let isAuth = _.get(errors, ['type']) === 'auth'
        if (isAuth) {
            observer.$data.isAuth = true
            errors = _.get(errors, ['errors'], [])
        }
        let aux = {}
        for (const key of Object.keys(errors)) {
            if (errors.hasOwnProperty(key)) {
                aux[key] = errors[key]
            }
        }
        observer.setErrors(aux)
    },

    onlyNumbers(evt) {
        evt = evt || window.event
        let charCode = (evt.which) ? evt.which : evt.keyCode
        switch (true) {
            case (charCode >= 48 && charCode <= 105):
            case (charCode === 8):
            case (charCode === 9):
            case (charCode === 27):
            case (charCode === 37):
            case (charCode === 39):
            case (charCode === 46):
            case (charCode === 144):
                return true
            default:
                evt.preventDefault()
                break
        }
    },

    /**
     * Format a certain number
     * @author Locutus (http://locutus.io)
     *
     * @param {double}  number - Plain Number
     * @param {string} [decimal=.] - Decimal separator
     * @param {string} [thousand=,] - Thousands separator
     * @param {int} [fix=2] - Number of decimals
     * @return {string}
     */
    numberFormat(number, decimal, thousand, fix) {
        let TheNumber = (number + '').replace(/[^0-9+\-Ee.]/g, '')
        let n = ((!isFinite(+TheNumber)) ? 0 : +TheNumber)
        let prec = ((!isFinite(+fix)) ? 2 : Math.abs(fix))
        let sep = ((typeof thousand === 'undefined') ? ',' : thousand)
        let dec = ((typeof decimal === 'undefined') ? '.' : decimal)
        let s = ''
        let toFixedFix = (n, prec) => {
            let k = Math.pow(10, prec)
            return '' + (Math.round(n * k) / k)
                .toFixed(prec)
        }
        // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || ''
            s[1] += new Array(prec - s[1].length + 1).join('0')
        }
        let regex = RegExp('\\' + dec + '00', 'g')
        TheNumber = s.join(dec)
        return TheNumber.replace(regex, '')
    },

    /**
     * Format a specific number based on the data array
     *
     * @param {double} number
     * @param {object} data
     * @returns {*|string}
     * @constructor
     */
    ObjectNumberFormat(number, data) {
        let decimal = _.get(data, ['decimal'], '.')
        let thousand = _.get(data, ['thousand'], ',')
        let fix = _.get(data, ['fix'], 2)
        return this.numberFormat(number, decimal, thousand, fix)
    },

    /**
     * Returns a number with currency symbol
     *
     * @param {double|string} number - value with or without format
     * @param {object} data - currency arrangement
     * @param {boolean} hasFormat - If the number already has format
     * @returns {string}
     */
    currencyFormat(number, data, hasFormat = false) {
        if (!hasFormat) {
            number = this.ObjectNumberFormat(number, data)
        }
        let position = _.get(data, ['position'], 'left')
        let symbol = _.get(data, ['symbol'], '$')
        switch (position) {
            case 'left':
                return `${symbol} ${number}`
            case 'right':
                return `${number} ${symbol}`
            default:
                return `${symbol} ${number}`
        }
    },

    /**
     * Returns a number with an ISO symbol
     *
     * @param {double|string} number - value with or without format
     * @param {object} data - currency arrangement
     * @param {boolean} hasFormat - If the number already has format
     * @returns {string}
     */
    currencyISOFormat(number, data, hasFormat = false) {
        if (!hasFormat) {
            number = this.ObjectNumberFormat(number, data)
        }
        let iso = _.get(data, ['code'], 'MXN')
        return `${iso} ${number}`
    },

    /**
     * It allows the execution of a function in time intervals
     *
     * @param {function} fn - Function
     * @param {int} time - Time interval
     */
    Timer(fn, time) {
        let timerObj = setInterval(fn, time)

        this.stop = () => {
            if (timerObj) {
                clearInterval(timerObj)
                timerObj = null
            }
            return this
        }

        // start timer using current settings (if it's not already running)
        this.start = () => {
            if (!timerObj) {
                this.stop()
                timerObj = setInterval(fn, time)
            }
            return this
        }

        // start with new interval, stop current interval
        this.reset = (newT) => {
            time = newT
            return this.stop().start()
        }
    },

    /**
     * Change the language of Google Recaptcha
     *
     * @param refs - HTML DOM
     * @param {string} language - Language it will take (read google doc)
     */
    setRecaptchaLang(refs, language) {
        let element = refs.getElementsByTagName('iframe')
        if (element[0]) {
            let src = element[0].getAttribute('src')
            let lang = src.match(/hl=(.*?)&/).pop()
            if (lang !== language) {
                src = src.replace(/hl=(.*?)&/, `hl=${language}&`)
                element[0].setAttribute('src', src)
            }
        }
    },
    bin2hex(s) {
        let i
        let l
        let n
        let o = ''
        s += ''
        for (i = 0, l = s.length; i < l; i++) {
            n = s.charCodeAt(i).toString(16)
            o += ((n.length < 2) ? '0' + n : n)
        }
        return o
    },
    hex2bin(bin) {
        let ret = []
        let i = 0
        let l
        bin += ''
        for (l = bin.length; i < l; i += 2) {
            let c = parseInt(bin.substr(i, 1), 16)
            let k = parseInt(bin.substr(i + 1, 1), 16)
            if (isNaN(c) || isNaN(k)) {
                return false
            }
            ret.push((c << 4) | k)
        }
        return String.fromCharCode.apply(String, ret)
    },
    /**
     * Remove all diatrics from the given text.
     * @access public
     * @param {String} text
     * @returns {String}
     */
    normalizeToBase(text) {
        const rExps = [
            {re: /[\xC0-\xC6]/g, ch: 'A'},
            {re: /[\xE0-\xE6]/g, ch: 'a'},
            {re: /[\xC8-\xCB]/g, ch: 'E'},
            {re: /[\xE8-\xEB]/g, ch: 'e'},
            {re: /[\xCC-\xCF]/g, ch: 'I'},
            {re: /[\xEC-\xEF]/g, ch: 'i'},
            {re: /[\xD2-\xD6]/g, ch: 'O'},
            {re: /[\xF2-\xF6]/g, ch: 'o'},
            {re: /[\xD9-\xDC]/g, ch: 'U'},
            {re: /[\xF9-\xFC]/g, ch: 'u'},
            {re: /[\xC7-\xE7]/g, ch: 'c'},
            {re: /[\xD1]/g, ch: 'N'},
            {re: /[\xF1]/g, ch: 'n'}
        ]
        rExps.forEach((element) => {
            text = text ? text.replace(element.re, element.ch) : ''
        })
        return text
    },
    /**
     * Search string in object
     *
     * @param {string} terms - Terminos de busqueda
     * @param {array} obj - Objecto en donde se va a buscar (arreglo de objetos)
     * @param {array} path - Mapa de la llave del objeto
     */
    search(terms, obj, path) {
        const query = this.normalizeToBase(_.get(obj, path, '').toLowerCase())
        return query.indexOf(this.normalizeToBase(terms.toLowerCase())) > -1
    },
    regexPassword() {
        return /(^[\S]{8,}$)/
    },
    errorToast(message) {
        Notify.create({
            message: message,
            type: 'negative'
        })
    },
    successToast(message) {
        Notify.create({
            message: message,
            type: 'positive'
        })
    }
}

export {master}
