import Vue from 'vue';
import  VeeValidate from 'vee-validate';
import * as moment from 'moment/moment'

VeeValidate.Validator.extend('future_date', {
    getMessage: field => 'The ' + field + ' value must be greater than 24 hours',
    validate: value => moment().diff(moment(value,  "DD-MM-YYYY"), 'days') < 0
});

Vue.use(VeeValidate);
