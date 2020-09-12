<template>
    <section>
        <q-btn class="text-bold sm-btn q-mb-md" color="primary" flat icon="arrow_back_ios" label="Back to Invoices"
               no-caps to="/invoices"/>

        <section v-if="invoice">
            <div class="row justify-between q-py-sm">
                <div class="text-bold invoice-ref">INVOICE #{{invoice.ref}}</div>
                <div>
                    <div class="inline-block text-14" v-if="invoice.status === 'paid'">
                        Date Paid:
                        <span class="text-bold">{{invoice.paid_at | moment('MMMM Do, YYYY')}}</span>
                    </div>
                    <div class="inline-block text-14" v-else-if="invoice.status === 'issued'">
                        Date Issued:
                        <span class="text-bold">{{invoice.issued_at | moment('MMMM Do, YYYY')}}</span>
                    </div>
                    <div class="inline-block text-14" v-else>
                        Created:
                        <span class="text-bold">{{invoice.created_at | moment('MMMM Do, YYYY')}}</span>
                    </div>
                    <q-chip :class="{
                                'bg-light-blue-4' : invoice.status === 'draft',
                                'bg-amber' : invoice.status === 'issued',
                                'bg-green-8' : invoice.status === 'paid',
                                'bg-red-8' : invoice.status === 'due',
                                'text-white q-px-lg status q-ml-md': true,
                            }">
                        {{invoice.status | firstCaps}}
                    </q-chip>
                </div>
            </div>

            <div class="bg-white shadow-custom main-section">
                <section class="row justify-between q-px-lg q-py-lg">
                    <div class="row q-gutter-xl">
                        <div class="column">
                            <div class="subject-header">Amount Due</div>
                            <div>{{invoice.currency.iso}} {{invoice.total_amt}}</div>
                        </div>
                        <div class="column">
                            <div class="subject-header">Due Date</div>
                            <div>{{invoice.currency.iso}} {{invoice.due_date | moment('MMM DD, YYYY')}}</div>
                        </div>
                    </div>
                    <div class="q-gutter-md">
                        <q-btn @click="downloadInvoice(invoice.id)" class="shadow-btn text-bold sm-btn" color="white"
                               icon="save_alt" label="Download"
                               no-caps
                               text-color="black" unelevated/>
                        <q-btn class="shadow-btn text-bold sm-btn" color="orange-4" icon-right="keyboard_arrow_down"
                               label="Edit Invoice" no-caps text-color="white" unelevated>
                            <q-menu :offset="[0,15]">
                                <q-list style="min-width: 100px">
                                    <q-item @click="editInvoice" clickable v-close-popup
                                            v-if="invoice.status !== 'paid'">
                                        <q-item-section>Edit Invoice</q-item-section>
                                    </q-item>
                                    <q-item @click="sendInvoice" clickable v-close-popup
                                            v-if="invoice.status !== 'paid'">
                                        <q-item-section>{{invoice.status === 'issued' ? 'Res':'S'}}end Invoice
                                        </q-item-section>
                                    </q-item>
                                    <q-item @click="deleteInvoice" clickable v-close-popup>
                                        <q-item-section class="text-negative">Delete Invoice</q-item-section>
                                    </q-item>

                                </q-list>
                            </q-menu>
                        </q-btn>
                        <q-btn @click="markAsPaid(invoice.id)" class="shadow-btn text-bold sm-btn" color="green-8"
                               label="Mark as Paid" no-caps text-color="white" unelevated
                               v-if="invoice.status !== 'paid'"/>
                    </div>
                </section>
            </div>

            <div class="row section-header">Customer Information</div>
            <div class="bg-white shadow-custom main-section">
                <section class="row justify-between q-px-lg q-py-lg">
                    <div class="row q-gutter-xl">
                        <div class="column">
                            <div class="subject-header">Customer Name</div>
                            <div>Anonymous Customer</div>
                        </div>
                        <div class="column">
                            <div class="subject-header">Phone Number</div>
                            <div>N/A</div>
                        </div>
                        <div class="column">
                            <div class="subject-header">Email</div>
                            <div>{{invoice.to_email}}</div>
                        </div>
                        <div class="column" v-if="invoice.cc_emails">
                            <div class="subject-header">Cc emails</div>
                            <div>{{invoice.cc_emails}}</div>
                        </div>
                    </div>
                </section>
            </div>

            <div class="row section-header">Invoice Details</div>
            <div class="row justify-between bg-white shadow-custom main-section">
                <section class="col-7 q-px-lg q-py-lg">
                    <q-markup-table class="no-shadow no-click">
                        <thead>
                        <tr>
                            <th class="text-center">Item</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Unit Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr :key="item.id" class="ref_table_body" v-for="(item, index) in invoice.items">
                            <template>
                                <td class="text-center">{{item.item}}</td>
                                <td class="text-center">{{item.quantity}}</td>
                                <td class="text-center">{{item.unit_price | formatAmount }}</td>
                            </template>
                        </tr>

                        </tbody>

                    </q-markup-table>
                    <!--                    <div class="row q-gutter-xl">
                                            <div class="column">
                                                <div class="subject-header">Remind before due date</div>
                                                <div class="column q-gutter-sm q-pt-sm">
                                                    <q-checkbox dense label="14 days before" val="due"/>
                                                    <q-checkbox dense label="7 days before" val="paid"/>
                                                    <q-checkbox dense label="3 days before" val="issued"/>
                                                </div>
                                            </div>
                                            <div class="column">
                                                <div class="subject-header">Remind on due date</div>
                                                <div class="column q-gutter-sm q-pt-sm">
                                                    <q-checkbox dense label="On due date" val="due"/>
                                                </div>
                                            </div>
                                            <div class="column">
                                                <div class="subject-header">Remind after due date</div>
                                                <div class="column q-gutter-sm q-pt-sm">
                                                    <q-checkbox dense label="3 days after" val="due"/>
                                                    <q-checkbox dense label="7 days after" val="paid"/>
                                                    <q-checkbox dense label="14 days after" val="issued"/>
                                                </div>
                                            </div>
                                        </div>-->
                </section>
                <section class="col-4 q-pr-lg q-py-lg summary">
                    <div class="row justify-between">
                        <span>Subtotal</span>
                        <span>{{invoice.currency.iso}} {{subtotal | formatAmount}}</span>
                    </div>
                    <div class="row justify-between">
                        <span>Shipping Fee</span>
                        <span>{{invoice.currency.iso}} {{invoice.shipping_fee | formatAmount}}</span>
                    </div>
                    <div class="row justify-between">
                        <span>Discount</span>
                        <span>{{invoice.currency.iso}} {{invoice.discount | formatAmount}}</span>
                    </div>
                    <div class="row justify-between">
                        <span>VAT</span>
                        <span>{{invoice.currency.iso}} {{invoice.tax | formatAmount}}</span>
                    </div>
                    <div class="row justify-between text-bold q-mt-md q-pt-md"
                         style="border-top: 1px solid whitesmoke">
                        <span>Total</span>
                        <span>{{invoice.currency.iso}}  {{total | formatAmount}}</span>
                    </div>

                </section>
                <section class="q-px-lg main-section" v-if="invoice.notes">
                    <div class="row subject-header">
                        <div>Notes</div>
                    </div>
                    <div>{{invoice.notes}}</div>

                </section>
            </div>


        </section>
        <section class="row justify-center" v-else>
            <q-spinner :thickness="1"
                       class="q-mt-xl"
                       color="orange-4"
                       size="4em"
            />
        </section>


    </section>
</template>

<script>

    import { master } from '../../../helpers/master'
    import { mapFields } from 'vuex-map-fields'

    export default {
        name: 'InvoiceDetails',
        meta () {
            return {
                title: 'View Invoice Details - Invoices'
            }
        },
        props: ['id'],
        data () {
            return {
                dialog: false,
                invoice: null,
                processing: false
            }
        },
        computed: {
            subtotal () {
                return this.$collect(this.invoice.items).filter(function (item, $key) {
                    return item.unit_price && item.quantity
                }).sum(item => item.unit_price * item.quantity)
            },
            total () {
                return parseFloat(this.subtotal) +
                    parseFloat(this.invoice.shipping_fee || 0) +
                    parseFloat(this.invoice.discount || 0) +
                    parseFloat(this.invoice.tax || 0)
            },
            ...mapFields('invoices', ['form'])
        },
        created () {
            this.fetchInvoice()
        },
        methods: {
            async exportData () {
                const response = await this.$axios.get('invoices/filter', {
                    params: { export: true, ...this.filter }
                })
                return response.data.data
            },
            async fetchInvoice () {
                this.processing = true

                const response = await this.$axios.get(`invoice/${this.id}`, {
                    params: this.filter
                })
                const { data: { status, msg, data } } = response
                if (status) {
                    this.invoice = data
                } else {
                    this.$q.notify({
                        color: 'negative',
                        position: 'top-right',
                        message: msg,
                        icon: 'cancel'
                    })
                }
                this.processing = false
            },
            async deleteInvoice () {
                this.$q.dialog({
                    title: 'Confirm',
                    message: 'The action is irreversible. Are you sure you want to do this?',
                    cancel: true,
                    persistent: true,
                    color: 'primary'
                }).onOk(async () => {
                    this.processing = true

                    const response = await this.$axios.delete(`invoice/${this.id}`)
                    const { data: { status, msg, data } } = response
                    if (status) {
                        this.$q.notify({
                            color: 'positive',
                            position: 'top-right',
                            message: msg,
                            icon: 'check_circle'
                        })
                        this.$router.push('/invoices')
                    } else {
                        this.$q.notify({
                            color: 'negative',
                            position: 'top-right',
                            message: msg,
                            icon: 'cancel'
                        })
                    }
                    this.processing = false
                })
            },
            async markAsPaid () {
                this.$q.dialog({
                    title: 'Confirm',
                    message: 'Are you sure you want to do this?',
                    cancel: true,
                    persistent: true,
                    color: 'positive'
                }).onOk(async () => {
                    this.processing = true

                    const response = await this.$axios.post(`invoice/${this.id}/markAsPaid`)
                    const { data: { status, msg, data: { invoice } } } = response
                    if (status) {
                        this.$q.notify({
                            color: 'positive',
                            position: 'top-right',
                            message: msg,
                            icon: 'check_circle'
                        })
                        this.invoice = invoice
                    } else {
                        this.$q.notify({
                            color: 'negative',
                            position: 'top-right',
                            message: msg,
                            icon: 'cancel'
                        })
                    }
                    this.processing = false
                })
            },
            async downloadInvoice (id) {
                this.processing = true

                const response = await this.$axios.post(`invoice/${id}/downloadInvoice`)
                const { data: { status, msg, data: { file } } } = response
                if (status) {
                    this.$q.notify({
                        color: 'positive',
                        position: 'top-right',
                        message: msg,
                        icon: 'check_circle'
                    })

                    let fileURL = new URL(master.invoices(file))
                    let fileLink = document.createElement('a')

                    fileLink.href = fileURL.toString()
                    fileLink.setAttribute('download', `${file}`)
                    // fileLink.setAttribute('target', '_blank')
                    document.body.appendChild(fileLink)

                    fileLink.click()

                } else {
                    this.$q.notify({
                        color: 'negative',
                        position: 'top-right',
                        message: msg,
                        icon: 'cancel'
                    })
                }
                this.processing = false
            },
            async sendInvoice () {
                this.$q.dialog({
                    title: 'Confirm',
                    message: 'Please confirm you really want to do this',
                    cancel: true,
                    persistent: true,
                    color: 'primary'
                }).onOk(async () => {
                    this.processing = true

                    const response = await this.$axios.post(`invoice/${this.id}/sendInvoice`)
                    const { data: { status, msg, data: { invoice } } } = response
                    if (status) {
                        this.invoice = invoice
                        this.$q.notify({
                            color: 'positive',
                            position: 'top-right',
                            message: msg,
                            icon: 'check_circle'
                        })
                    } else {
                        this.$q.notify({
                            color: 'negative',
                            position: 'top-right',
                            message: msg,
                            icon: 'cancel'
                        })
                    }
                    this.processing = false
                })
            },
            editInvoice () {
                delete this.invoice.issued_at;
                this.invoice.due_date = this.$moment(this.invoice.due_date).format('DD-MM-YYYY')
                this.invoice.items = _.map(this.invoice.items, (item) => {
                    item.title = item.item
                    return item;
                })
                this.form = this.invoice
                this.$router.push('/invoices/create')
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

<style scoped>
    .status {
        border: solid 1px white;
        font-size: 12px;
        font-weight: bold;
    }

    .invoice-ref {
        font-size: 1.4em;
    }

    .subject-header {
        color: #637381;
    }

    .section-header {
        font-weight: 600;
        margin-top: 30px;
        margin-bottom: 10px;
        color: #637381;
        font-size: 15px;
    }

    .summary > div {
        margin-bottom: 3px;
    }

    .summary > div > span:first-child {
        font-weight: bold;
    }


</style>
