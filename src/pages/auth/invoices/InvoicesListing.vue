<template>
    <div class="bg-white shadow-custom main-section">

        <section class="row justify-between q-px-lg q-py-lg">
            <div class="q-mt-auto q-mb-auto text-bold">
                <div v-if="invoices">{{invoices.total}} invoice{{invoices.total > 1 ? 's' : ''}}</div>
                <div v-else>
                    <q-skeleton type="rect" width="10rem"/>
                </div>
            </div>
            <div class="q-gutter-md no-wrap action-btns">
                <q-btn class="shadow-btn text-bold" color="white" icon="filter_alt" label="Filter" no-caps
                       text-color="black" unelevated>
                    <q-menu :offset="[0, 15]" anchor="bottom right" self="top right">
                        <section style="width: 320px">
                            <div class="filter-section">
                                <div class="row q-pl-lg q-py-sm text-bold filter-header">Email</div>
                                <q-input class="q-my-md q-mx-md" dense outlined
                                         placeholder="Email" v-model="filter.email"/>
                            </div>
                            <div class="filter-section">
                                <div class="row q-pl-lg q-py-sm text-bold filter-header">Date</div>
                                <div class="row justify-around no-wrap q-my-md q-mx-sm">
                                    <q-input @click="$refs.dateFrom.show()" class="col-5" dense
                                             outlined placeholder="From" v-model="filter.date_range.from">
                                        <template v-slot:append>
                                            <div>
                                                <q-popup-proxy context-menu ref="dateFrom"
                                                               transition-hide="scale"
                                                               transition-show="scale">
                                                    <q-date @input="() => {$refs.dateFrom.hide();}"
                                                            color="theme-orange" mask="DD-MM-YYYY"
                                                            v-model="filter.date_range.from"></q-date>
                                                </q-popup-proxy>
                                            </div>
                                        </template>
                                    </q-input>
                                    <q-input @click="$refs.dateTo.show()" class="col-5" dense
                                             outlined placeholder="To" v-model="filter.date_range.to">
                                        <template v-slot:append>
                                            <div>
                                                <q-popup-proxy context-menu ref="dateTo"
                                                               transition-hide="scale"
                                                               transition-show="scale">
                                                    <q-date @input="() => {$refs.dateTo.hide();}"
                                                            color="theme-orange" mask="DD-MM-YYYY"
                                                            v-model="filter.date_range.to"></q-date>
                                                </q-popup-proxy>
                                            </div>
                                        </template>
                                    </q-input>
                                </div>
                            </div>
                            <div class="filter-section">
                                <div class="row q-pl-lg q-py-sm text-bold filter-header">Status</div>
                                <div class="row justify-around q-my-md q-mx-md">
                                    <q-checkbox dense label="Due" v-model="filter.status" val="due"/>
                                    <q-checkbox dense label="Paid" v-model="filter.status" val="paid"/>
                                    <q-checkbox dense label="Issued" v-model="filter.status" val="issued"/>
                                    <q-checkbox dense label="Draft" v-model="filter.status" val="draft"/>
                                </div>
                            </div>
                            <div class="filter-section">
                                <div class="row justify-between q-px-md q-py-sm">
                                    <q-btn @click="resetFilter" class="shadow-btn text-bold" label="Reset"
                                           size="sm" unelevated/>
                                    <q-btn @click="filterInvoices" class="shadow-btn text-bold" color="orange-4"
                                           label="Filter" no-caps
                                           size="sm" text-color="white" unelevated/>
                                </div>
                            </div>
                        </section>
                    </q-menu>
                </q-btn>
                <q-btn to="invoices/create" class="shadow-btn text-bold" color="orange-4" label="New Invoice" no-caps
                       text-color="white" unelevated/>
                <json-excel
                    :export-fields="csv_fields"
                    :fetch="exportData"
                    class=" inline-block"
                    name="Invoices.csv"
                    style="vertical-align: middle"
                    type="csv">
                    <q-btn class="shadow-btn text-bold" color="white" icon="description" label="Export" no-caps
                           text-color="black" unelevated/>
                </json-excel>
            </div>
        </section>
        <section v-if="invoices">
            <template v-if="invoices.total">
                <q-markup-table class="no-shadow">
                    <thead>
                    <tr>
                        <th class="text-center">Status</th>
                        <th class="text-left">Ref.</th>
                        <th class="text-left">Client</th>
                        <th class="text-left">Amount</th>
                        <th class="text-left">Date Created</th>
                        <th class="text-left">Due Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr :key="invoices.id" @click="gotoDetails(invoice.id)" class="ref_table_body"
                        v-for="(invoice, index) in invoices.data">
                        <template v-if="!processing">
                            <td class="text-center">
                                <q-chip :class="{
                                'bg-light-blue-4' : invoice.status === 'draft',
                                'bg-amber' : invoice.status === 'issued',
                                'bg-green-8' : invoice.status === 'paid',
                                'bg-red-8' : invoice.status === 'due',
                                'text-white q-px-lg status': true,
                            }">
                                    {{invoice.status | firstCaps}}
                                </q-chip>
                            </td>
                            <td class="text-left">#{{invoice.ref}}</td>
                            <td class="text-left">{{invoice.to_email}}</td>
                            <td class="text-left">{{invoice.currency.iso}} {{invoice.total_amt}}</td>
                            <td class="text-left">{{invoice.created_at | moment('Do MMMM, YYYY')}}</td>
                            <td class="text-left">{{invoice.due_date | moment('Do MMMM, YYYY')}}</td>
                        </template>
                        <template v-else>
                            <td class="text-left" v-for="n in 6">
                                <q-skeleton type="rect"/>
                            </td>
                        </template>
                    </tr>

                    </tbody>

                </q-markup-table>
                <div class="row justify-center q-py-lg items-center">
                    <q-btn :disable="invoices.prev_page_url === null"
                           @click="filterInvoices('prev')" class="q-mr-sm text-bold" color="primary"
                           flat label="PREV" size=".9em"/>
                    <q-btn :disable="invoices.next_page_url === null" @click="filterInvoices('next')"
                           class="text-bold" color="primary"
                           flat label="NEXT" size=".9em"/>
                </div>
            </template>
            <template v-else>
                <div class="q-py-lg no-wrap text-center items-center text-grey">
                    <q-icon name="notes" style="font-size: 2rem;"/>
                    <div class="text-h6 text-center">No Invoices</div>
                    <div class="text-center q-pt-lg">
                        There're no invoices yet. It could also be as a result of the filter query.
                    </div>
                </div>
            </template>
        </section>
        <section v-else>
            <q-markup-table class="no-shadow" highlight responsive separator="none">
                <tbody>
                <tr v-for="n in 5">
                    <td class="text-left" v-for="n in 6">
                        <q-skeleton type="rect"/>
                    </td>
                </tr>
                </tbody>
            </q-markup-table>
        </section>
    </div>
</template>

<script>
    import JsonExcel from 'vue-json-excel'

    export default {
        name: 'InvoicesListing',
        meta () {
            return {
                title: 'View All Invoices - Invoices'
            }
        },
        components: {
            JsonExcel,
        },
        data () {
            return {
                dialog: false,
                invoices: null,
                filter: {
                    email: '',
                    date_range: {
                        from: '',
                        to: ''
                    },
                    status: [],
                    page: 1,
                    per_page: '15'
                },
                csv_fields: {
                    'Status': 'status',
                    'Ref': 'ref',
                    'Currency': 'currency.iso',
                    'To': 'to_email',
                    'Cc': 'cc_emails',
                    'Notes': 'notes',
                    'Items': {
                        field: 'items',
                        callback: (value) => {
                            let info = ''
                            value.forEach(function (element) {
                                info += `${element.item} — ${element.quantity} — ${element.unit_price}; `
                            })
                            return info
                        }
                    },
                    'Date Created': 'created_at',
                    'Date Paid': 'paid_at',
                    'Due Date': 'due_date',
                },
                entries: {
                    to: '',
                    total: ''
                },
                processing: false
            }
        },
        computed: {
            total () {
                return parseFloat(this.subtotal) +
                    parseFloat(this.invoice.shipping_fee || 0) +
                    parseFloat(this.invoice.discount || 0) +
                    parseFloat(this.invoice.tax || 0)
            },
        },
        created () {
            this.filterInvoices()
        },
        methods: {
            async exportData () {
                const response = await this.$axios.get('invoices/filter', {
                    params: { export: true, ...this.filter }
                })
                return response.data.data
            },
            async filterInvoices (type) {
                this.processing = true
                if (type === 'next') {
                    this.filter.page++
                } else if (type === 'prev') {
                    this.filter.page--
                } else {
                    this.filter.page = 1
                }

                const response = await this.$axios.get('invoices/filter', {
                    params: this.filter
                })
                const { data: { status, msg, data } } = response
                if (status) {
                    this.invoices = data
                } else {
                    this.$q.notify({
                        color: 'warning',
                        message: msg,
                        icon: 'fa fa-exclamation-circle'
                    })
                }
                this.processing = false
            },
            gotoDetails (id) {
                this.$router.push(`invoices/${id}`)
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


    .action-btns >>> .q-btn {
        font-size: 12px;
    }

    .action-btns >>> .q-btn .q-icon {
        font-size: 12px;
    }

    .status {
        border: solid 1px white;
        font-size: 12px;
        font-weight: bold;
    }

    .q-field >>> .q-field__control {
        height: 32px;
    }

    .filter-header {
        color: #25303a;
        background: #f4f6f8;
    }

    .q-checkbox >>> .q-checkbox__inner {
        color: #E6E7E9;
    }

    .q-checkbox >>> .q-checkbox__inner--truthy {
        color: var(--q-color-primary)
    }

    .q-checkbox--dense >>> .q-checkbox__inner {
        width: .4em;
        min-width: .4em;
        height: .4em;
    }
</style>
