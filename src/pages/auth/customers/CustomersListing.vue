<template>
    <div class="bg-white shadow-custom main-section">

        <section class="row justify-between q-px-lg q-py-lg">
            <div class="q-mt-auto q-mb-auto text-bold">
                <div v-if="customers">{{customers.total}} customer{{customers.total > 1 ? 's' : ''}}</div>
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
                                <div class="row q-pl-lg q-py-sm text-bold filter-header">Phone</div>
                                <q-input class="q-my-md q-mx-md" dense outlined
                                         placeholder="Phone" v-model="filter.phone"/>
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
                                <div class="row justify-between q-px-md q-py-sm">
                                    <q-btn @click="resetFilter" class="shadow-btn text-bold" label="Reset"
                                           size="sm" unelevated/>
                                    <q-btn @click="filterCustomers" class="shadow-btn text-bold" color="orange-4"
                                           label="Filter" no-caps
                                           size="sm" text-color="white" unelevated/>
                                </div>
                            </div>
                        </section>
                    </q-menu>
                </q-btn>
                <q-btn @click="createCustomer" class="shadow-btn text-bold" color="orange-4" label="New Customer"
                       no-caps
                       text-color="white" unelevated/>
                <json-excel
                    :export-fields="csv_fields"
                    :fetch="exportData"
                    class=" inline-block"
                    name="Customers.csv"
                    style="vertical-align: middle"
                    type="csv">
                    <q-btn class="shadow-btn text-bold" color="white" icon="description" label="Export" no-caps
                           text-color="black" unelevated/>
                </json-excel>
            </div>
        </section>
        <section v-if="customers">
            <template v-if="customers.total">
                <q-markup-table class="no-shadow">
                    <thead>
                    <tr>
                        <th class="text-center">Name</th>
                        <th class="text-left">Email</th>
                        <th class="text-left">Phone</th>
                        <th class="text-left">Address</th>
                        <th class="text-left">Date Created</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr :key="customers.id" class="ref_table_body"
                        v-for="(customer, index) in customers.data">

                        <template v-if="!processing">
                            <td :title="customer.name" class="text-center">{{customer.name}}</td>
                            <td :title="customer.email" class="text-left">{{customer.email | trimString(25)}}</td>
                            <td :title="customer.phone" class="text-left">{{customer.phone}}</td>
                            <td :title="customer.full_address" class="text-left">
                                {{customer.full_address |trimString(25)}}
                            </td>
                            <td :title="customer.created_at" class="text-left">
                                {{customer.created_at | moment('Do MMMM, YYYY')}}
                            </td>
                            <td class="text-right">
                                <q-btn color="primary" flat icon="more_vert" size="sm">
                                    <q-menu :offset="[0, 15]">
                                        <q-list style="min-width: 100px">
                                            <q-item @click="editCustomer(customer)" clickable v-close-popup>
                                                <q-item-section>Edit</q-item-section>
                                            </q-item>
                                            <q-item @click="deleteCustomer(customer.id)" clickable v-close-popup>
                                                <q-item-section class="text-negative">Delete</q-item-section>
                                            </q-item>

                                        </q-list>
                                    </q-menu>
                                </q-btn>
                            </td>
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
                    <q-btn :disable="customers.prev_page_url === null"
                           @click="filterCustomers('prev')" class="q-mr-sm text-bold" color="primary"
                           flat label="PREV" size=".9em"/>
                    <q-btn :disable="customers.next_page_url === null" @click="filterCustomers('next')"
                           class="text-bold" color="primary"
                           flat label="NEXT" size=".9em"/>
                </div>
            </template>
            <template v-else>
                <div class="q-py-lg no-wrap text-center items-center text-grey">
                    <q-icon name="notes" style="font-size: 2rem;"/>
                    <div class="text-h6 text-center">No Customers</div>
                    <div class="text-center q-pt-lg">
                        There're no customers yet. It could also be as a result of the filter query.
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

        <EditCustomer :customer="selectedCustomer"/>
    </div>
</template>

<script>
    import JsonExcel from 'vue-json-excel'
    import { mapFields } from 'vuex-map-fields'
    import EditCustomer from '../../../components/customers/EditCustomer'

    export default {
        name: 'CustomersListing',
        meta () {
            return {
                title: 'View All Customers - Invoices'
            }
        },
        components: {
            EditCustomer,
            JsonExcel,
        },
        data () {
            return {
                dialog: false,
                selectedCustomer: null,
                filter: {
                    email: '',
                    phone: '',
                    date_range: {
                        from: '',
                        to: ''
                    },
                    page: 1,
                    per_page: '20'
                },
                csv_fields: {
                    'Name': 'name',
                    'Email': 'email',
                    'Phone': 'phone',
                    'Address': 'address',
                    'City': 'city',
                    'State': 'state',
                    'Country': 'country.name',
                    'Date Created': 'created_at'
                },
                entries: {
                    to: '',
                    total: ''
                },
                processing: false
            }
        },
        computed: {
            ...mapFields('clients', ['customers', 'editCustomerModal'])
        },
        created () {
            this.filterCustomers()
        },
        methods: {
            async exportData () {
                const response = await this.$axios.get('customers/filter', {
                    params: { export: true, ...this.filter }
                })
                return response.data.data
            },
            async filterCustomers (type) {
                this.processing = true
                if (type === 'next') {
                    this.filter.page++
                } else if (type === 'prev') {
                    this.filter.page--
                } else {
                    this.filter.page = 1
                }

                const response = await this.$axios.get('customers/filter', {
                    params: this.filter
                })
                const { data: { status, msg, data } } = response
                if (status) {
                    this.customers = data
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
                this.$router.push(`customers/${id}`)
            },
            createCustomer () {
                this.editCustomerModal = true
            },
            editCustomer (customer) {
                this.selectedCustomer = {...customer}
                this.editCustomerModal = true
            },
            async deleteCustomer (id) {
                this.$q.dialog({
                    title: 'Confirm',
                    message: 'The action is irreversible. Are you sure you want to do this?',
                    cancel: true,
                    persistent: true,
                    color: 'positive'
                }).onOk(async () => {
                    this.processing = true

                    const response = await this.$axios.delete(`customer/${id}`)
                    const { data: { status, msg, data } } = response
                    if (status) {
                        this.$q.notify({
                            color: 'positive',
                            position: 'top-right',
                            message: msg,
                            icon: 'check_circle'
                        })
                        this.customers.total--
                        _.remove(this.customers.data, (cust) => cust.id === id )
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
