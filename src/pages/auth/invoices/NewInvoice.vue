<template>
    <section>
        <q-btn class="text-bold sm-btn q-mb-md" color="primary" flat icon="arrow_back_ios" label="Back to Invoices"
               no-caps to="/invoices"/>


        <div class="bg-white shadow-custom main-section">
            <section class="row justify-between q-px-lg q-py-lg">
                <div class="text-bold text-16">Create Invoice</div>
                <div class="q-gutter-md">
                    <q-btn :disable="isProcessing" @click="saveInvoice(false)" class="shadow-btn text-bold sm-btn"
                           color="white" label="Save Invoice"
                           no-caps text-color="black" unelevated/>
                    <q-btn :disable="isProcessing" @click="saveInvoice(true)" class="shadow-btn text-bold sm-btn"
                           color="orange-4" label="Send Invoice" no-caps text-color="white" unelevated/>
                </div>
            </section>

            <section class="row q-gutter-md q-px-lg q-py-lg">
                <div class="col-5">
                    <div class="row justify-between subject-header">
                        <div>To</div>
                        <div @click="addCustomer" class="link-btn">
                            <q-icon class="q-pr-sm" name="add"/>
                            <span>New Customer</span>
                        </div>
                    </div>

                    <q-select :hint="errors.first('email')"
                              :options="customers_options"
                              @filter="filterFn_Customers"
                              @input-value="setToEmail"
                              bg-color="white"
                              dense emit-value
                              fill-input
                              hide-selected input-debounce="0"
                              map-options
                              name="email" outlined use-input
                              v-model="form.to_email"
                              v-validate="'required'"
                    />

                    <div @click="add_cc_emails = !add_cc_emails" class="link-btn q-pt-md" v-if="!add_cc_emails">
                        <q-icon class="q-pr-sm" name="add"/>
                        <span>Send to multiple emails</span>
                    </div>
                    <div @click="add_cc_emails = !add_cc_emails" class="link-btn q-pt-md" v-else>
                        <q-icon class="q-pr-sm" name="remove"/>
                        <span>Hide multiple emails</span>
                    </div>
                </div>
                <div class="col-3">
                    <div class="row justify-between subject-header">
                        <div class="q-my-auto">Due Date</div>
                    </div>
                    <q-input :hint="errors.first('due date')" @click="$refs.dueDate.show()" class="col-5" dense
                             name="due date" outlined placeholder="Due Date" v-model="form.due_date"
                             v-validate="'required|date_format:dd-MM-yyyy'">
                        <template v-slot:append>
                            <div>
                                <q-popup-proxy context-menu ref="dueDate"
                                               transition-hide="scale"
                                               transition-show="scale">
                                    <q-date @input="() => {$refs.dueDate.hide();}"
                                            color="theme-orange" mask="DD-MM-YYYY"
                                            v-model="form.due_date"></q-date>
                                </q-popup-proxy>
                            </div>
                        </template>
                    </q-input>
                </div>
                <div class="col-3">
                    <div class="row justify-between subject-header">
                        <div>Currency</div>
                    </div>
                    <q-select
                        :options="currency_options"
                        @filter="filterFn"
                        bg-color="white"
                        dense emit-value
                        fill-input hide-selected
                        input-debounce="200" map-options
                        outlined use-input
                        v-model="form.currency"
                    />
                </div>
            </section>

            <!--            Other emails-->
            <section class="q-gutter-md q-px-lg q-py-lg" v-show="add_cc_emails">
                <div class="row subject-header">
                    <div>Other Emails (Cc)</div>
                </div>
                <q-input outlined placeholder="Enter other emails seperated by comma" v-model="form.cc_emails"/>
            </section>

            <!--            Items-->
            <section class="q-px-lg  q-pb-lg">
                <div class="row q-gutter-md  no-wrap q-pt-lg q-pb-sm ">
                    <div class="col-4 text-bold">Invoice Item</div>
                    <div class="col-2 text-bold">Quantity</div>
                    <div class="col-2 text-bold">Unit Price</div>
                    <div class="col-2 text-bold text-right">Amount</div>
                </div>
                <Item :closeable="form.items.length > 1" :id="n-1" :key="n"
                      v-for="n in form.items.length"/>
                <div @click="addItem" class="link-btn q-pt-md">
                    <q-icon class="q-pr-sm" name="add"/>
                    <span>Add another item</span>
                </div>
            </section>

            <!--            Payment and Total-->
            <section class="q-pl-lg q-pr-xl q-py-lg">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="row subject-header">
                            <div>Notes</div>
                        </div>
                        <q-input name="account number" outlined placeholder="Notes" style="width: 90%"
                                 type="textarea" v-model="form.notes"/>


                        <div class="row justify-between q-pt-lg q-pb-md">
                            <div class="text-grey text-bold">Payment Information</div>
                        </div>
                        <div class="row justify-between" style="width: 90%">
                            <div class="col-3">
                                <div class="row subject-header">
                                    <div>Bank</div>
                                </div>
                                <q-select
                                    :hint="errors.first('bank')" :options="banks_options"
                                    @blur="verifyAccountNumber"
                                    @filter="filterFn_Banks"
                                    bg-color="white" dense
                                    emit-value fill-input
                                    hide-selected input-debounce="200"
                                    map-options name="bank"
                                    outlined use-input
                                    v-model="form.bank"
                                    v-validate="'required'"
                                />
                            </div>
                            <div class="col-3">
                                <div class="row subject-header">
                                    <div>Account Number</div>
                                </div>
                                <q-input :hint="errors.first('account number')" @blur="verifyAccountNumber"
                                         name="account number"
                                         outlined placeholder="Account Number" v-model="form.acc_num"
                                         v-validate="'required|digits:10'"/>
                            </div>
                            <div class="col-5">
                                <div class="row subject-header">
                                    <div>Account Name</div>
                                </div>
                                <q-input :error="acc_unresolved" :error-message="acc_hint"
                                         :hint="errors.first('account name')"
                                         name="account name"
                                         outlined placeholder="Account name"
                                         readonly v-model="form.acc_name" v-validate="'required'"/>
                            </div>

                        </div>
                    </div>
                    <div class="col-4 summary">
                        <div class="row justify-between">
                            <span>Subtotal</span>
                            <span>{{form.currency}} {{subtotal | formatAmount}}</span>
                        </div>
                        <div class="row justify-between">
                            <span>Shipping Fee</span>
                            <div class="link-btn">
                                <q-icon class="q-pr-sm" name="add"/>
                                <span>Add</span>
                                <q-popup-edit auto-save v-model="form.shipping_fee">
                                    <q-input autofocus dense type="number" v-model="form.shipping_fee"/>
                                </q-popup-edit>
                            </div>
                            <span>{{form.currency}} {{form.shipping_fee | formatAmount}}</span>
                        </div>
                        <div class="row justify-between">
                            <span>Discount</span>
                            <div class="link-btn">
                                <q-icon class="q-pr-sm" name="add"/>
                                <span>Add</span>
                                <q-popup-edit auto-save v-model="form.discount">
                                    <q-input autofocus dense type="number" v-model="form.discount"/>
                                </q-popup-edit>
                            </div>
                            <span>{{form.currency}} {{form.discount | formatAmount}}</span>
                        </div>
                        <div class="row justify-between">
                            <span>VAT</span>
                            <div class="link-btn">
                                <q-icon class="q-pr-sm" name="add"/>
                                <span>Add</span>
                                <q-popup-edit auto-save v-model="form.tax">
                                    <q-input autofocus dense type="number" v-model="form.tax"/>
                                </q-popup-edit>
                            </div>
                            <span>{{form.currency}} {{form.tax | formatAmount}}</span>
                        </div>
                        <div class="row justify-between text-bold q-mt-md q-pt-md"
                             style="border-top: 1px solid whitesmoke">
                            <span>Total</span>
                            <span>{{form.currency}} {{total | formatAmount}}</span>
                        </div>

                    </div>
                </div>
            </section>
        </div>

        <EditCustomer :email="form.to_email"/>

    </section>
</template>

<script>

    import { UtilService } from '../../../services/UtilService'
    import { mapFields } from 'vuex-map-fields'
    import EditCustomer from '../../../components/customers/EditCustomer'
    import Item from '../../../components/invoices/Item'

    let currenciesData = []
    let customersData = []
    let banksData = []

    export default {
        name: 'NewInvoice',
        components: { Item, EditCustomer },
        meta () {
            return {
                title: 'Edit Invoice - Invoices'
            }
        },
        props: ['id'],
        data () {
            return {
                currency_options: null,
                customers_options: null,
                banks_options: null,
                add_cc_emails: false,
                processing: false,
                acc_unresolved: null,
                acc_hint: '',
                isProcessing: false
            }
        },
        computed: {
            subtotal () {
                return this.$collect(this.form.items).filter(function (item, $key) {
                    return item.unit_price && item.quantity
                }).sum(item => item.unit_price * item.quantity)
            },
            total () {
                return parseFloat(this.subtotal) +
                    parseFloat(this.form.shipping_fee || 0) +
                    parseFloat(this.form.discount || 0) +
                    parseFloat(this.form.tax || 0)
            },
            ...mapFields('clients', ['editCustomerModal']),
            ...mapFields('invoices', ['form', 'num_items'])
        },
        created () {
            this.fetchInvoiceFormOptions()
        },
        methods: {
            filterFn (val, update) {
                update(() => {
                    if (val === '') {
                        this.currency_options = currenciesData
                    } else {
                        const needle = val.toLowerCase()
                        this.currency_options = currenciesData.filter(
                            v => v.label.toLowerCase().indexOf(needle) > -1
                        )
                    }
                })
            },
            filterFn_Customers (val, update) {
                update(() => {
                    if (val === '') {
                        this.customers_options = customersData
                    } else {
                        const needle = val.toLowerCase()
                        this.customers_options = customersData.filter(
                            v => v.label.toLowerCase().indexOf(needle) > -1
                        )
                    }
                })
            },
            filterFn_Banks (val, update) {
                update(() => {
                    if (val === '') {
                        this.banks_options = banksData
                    } else {
                        const needle = val.toLowerCase()
                        this.banks_options = banksData.filter(
                            v => v.label.toLowerCase().indexOf(needle) > -1
                        )
                    }
                })
            },
            setToEmail (val) {
                this.form.to_email = val
            },
            async fetchInvoiceFormOptions () {
                const response = await UtilService.fetchInvoiceFormOptions()
                if (response.data.status) {
                    currenciesData = response.data.currencies
                    this.currency_options = currenciesData
                    customersData = response.data.customers
                    this.customers_options = customersData
                    banksData = response.data.banks
                    this.banks_options = banksData
                    this.form.currency = 'NGN'
                } else {
                    this.$q.notify({
                        color: 'negative',
                        icon: 'close',
                        message: response.data.msg,
                        position: 'top-right'
                    })
                }
            },
            async verifyAccountNumber () {
                if (this.form.bank !== '' && this.form.acc_num.length === 10) {
                    this.isProcessing = true
                    const response = await UtilService.verifyAccountNumber({
                        'acc_num': this.form.acc_num,
                        'bank': this.form.bank
                    })
                    if (response.data.status) {
                        this.form.acc_name = response.data.acc_name
                        this.acc_unresolved = false
                        this.acc_hint = ''
                    } else {
                        this.acc_unresolved = true
                        this.acc_hint = response.data.msg
                    }

                    this.isProcessing = false
                }
            },
            addCustomer () {
                this.editCustomerModal = true
            },
            addItem () {
                this.form.items.push({
                    title: '',
                    quantity: 1,
                    unit_price: ''
                })
            },
            async saveInvoice (sendInvoice = false) {
                const valid = await this.$validator.validateAll()
                if (valid) {
                    this.processing = true
                    this.form._send = sendInvoice

                    const response = await this.$axios.post('invoice/edit' + (this.id ? `/${this.id}` : ''), this.form)
                    const { data: { status, msg, data } } = response
                    if (status) {
                        this.$q.notify({
                            color: 'positive',
                            position: 'top-right',
                            message: msg,
                            icon: 'check_circle'
                        })
                        this.resetForm()
                        this.$router.replace('/invoices')
                    } else {
                        this.$q.notify({
                            color: 'negative',
                            position: 'top-right',
                            message: msg,
                            icon: 'cancel'
                        })
                    }
                    this.processing = false
                }
            },

            // Miscellaneous

            resetFilter () {
                this.filter.email = ''
                this.filter.date_range = {
                    from: '',
                    to: ''
                }
                this.filter.status = []
            },
            resetForm () {
                this.form = {
                    to_email: '',
                    due_date: '',
                    currency: null,
                    cc_emails: '',
                    notes: '',
                    acc_name: '',
                    bank: '',
                    acc_num: '',
                    shipping_fee: 0,
                    discount: 0,
                    tax: 0,
                    items: [
                        {
                            title: '',
                            quantity: '',
                            unit_price: ''
                        }
                    ],
                    _send: false
                }
            },
            firstCaps (string) {
                if (string == null) {
                    return
                }
                return (
                    string.charAt(0).toUpperCase() + string.slice(1).toLowerCase()
                )
            },
        },
        filters: {}
    }
</script>

<style lang="scss" scoped>
    .status {
        border: solid 1px white;
        font-size: 12px;
        font-weight: bold;
    }

    .invoice-ref {
        font-size: 1.4em;
    }

    .subject-header {
        padding-bottom: 6px;
    }

    .subject-header div:first-child {
        font-weight: bold;
    }

    .link-btn {
        color: $primary;
        cursor: pointer;
        font-size: 14px;
        margin-right: 6px;
        display: inline-block;
        /*padding-top: 10px;*/

        :hover {
            font-weight: bold;
        }
    }

    .main-section > section {
        border-bottom: solid 1px whitesmoke;
    }

    .summary > div {
        margin-bottom: 3px;
    }
</style>
