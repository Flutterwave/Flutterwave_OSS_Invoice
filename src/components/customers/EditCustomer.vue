<template>
    <div>
        <q-dialog @before-show="setFormValues" v-model="editCustomerModal">
            <q-card class="q-pa-sm" style="min-width: 500px; max-width: 70vw;">
                <q-card-section class="header row items-center q-card--bordered">
                    <div class="title text-bold">Add New Customer</div>
                    <q-btn class="q-ml-auto" dense flat icon="close" size="sm" v-close-popup/>
                </q-card-section>
                <q-card-section>
                    <div class="row q-pt-md q-pb-sm ">Name</div>
                    <q-input :hint="errors.first('name')" name="name" outlined
                             placeholder="Name" v-model="form.name"
                             v-validate="'required'"/>
                    <div class="row q-pt-md q-pb-sm ">Phone</div>
                    <q-input outlined placeholder="Phone" v-model="form.phone"/>
                    <div class="row q-pt-md q-pb-sm ">Email</div>
                    <q-input :hint="errors.first('email')" name="email" outlined
                             placeholder="Email" v-model="form.email"
                             v-validate="'required'"/>
                    <div class="row q-pt-md q-pb-sm ">Address</div>
                    <q-input outlined placeholder="Address" v-model="form.address"/>
                    <div class="row q-pt-md justify-between">
                        <div class="col-sm-5">
                            <div class=" q-pb-sm ">City</div>
                            <q-input outlined placeholder="City" v-model="form.city"/>
                        </div>
                        <div class="col-sm-5">
                            <div class=" q-pb-sm ">State</div>
                            <q-input outlined placeholder="State" v-model="form.state"/>
                        </div>
                    </div>
                    <div class="row q-pt-md q-pb-sm ">Country</div>
                    <q-select :hint="errors.first('country')"
                              :options="countries_options"
                              @filter="filterFn"
                              bg-color="white"
                              dense
                              emit-value fill-input
                              hide-selected input-debounce="200"
                              map-options
                              name="country" outlined use-input
                              v-model="form.country_id"
                              v-validate="'required'"
                    />
                </q-card-section>

                <q-card-actions align="right" class="q-pb-md q-pt-lg">
                    <q-btn class="shadow-btn text-bold q-mr-sm" label="Cancel" no-caps unelevated v-close-popup/>
                    <q-btn :loading="processing" @click="saveCustomer" class="shadow-btn text-bold" color="orange-4"
                           label="Save Customer" no-caps unelevated/>
                </q-card-actions>
            </q-card>
        </q-dialog>
    </div>
</template>

<script>
    import { mapFields } from 'vuex-map-fields'
    import { UtilService } from '../../services/UtilService'

    let countriesData = []

    export default {
        name: 'EditCustomer',
        props: ['customer', 'email'],
        data () {
            return {
                form: {},
                countries_options: null,
                processing: false
            }
        },
        computed: {
            ...mapFields('clients', ['customers', 'editCustomerModal'])
        },
        created () {
            this.fetchCountries()
        },
        methods: {
            setFormValues () {
                // {
                //     name: 'Obi Chidi',
                //         phone: '07032741119',
                //     email: 'obichidi@gmail.com',
                //     address: '4 Bishop Street',
                //     city: 'Surulere',
                //     state: 'Lagos',
                //     country_id: 162
                // }
                this.form = this.customer || {
                    name: '',
                    phone: '',
                    email: this.email || '',
                    address: '',
                    city: '',
                    state: '',
                    country_id: 162
                }
            },
            filterFn (val, update) {
                update(() => {
                    if (val === '') {
                        this.countries_options = countriesData
                    } else {
                        const needle = val.toLowerCase()
                        this.countries_options = countriesData.filter(
                            v => v.label.toLowerCase().indexOf(needle) > -1
                        )
                    }
                })
            },
            async fetchCountries () {
                const response = await UtilService.fetchCountries()
                if (response.data.status) {
                    countriesData = response.data.countries
                    this.countries_options = countriesData
                    this.form.country = 162
                } else {
                    this.$q.notify({
                        color: 'negative',
                        icon: 'close',
                        message: response.data.msg,
                        position: 'top-right'
                    })
                }
            },
            async saveCustomer () {
                const valid = await this.$validator.validateAll()
                if (valid) {
                    this.processing = true

                    const response = await this.$axios.post(`customer/edit`, this.form)
                    const { data: { status, msg, data: { customer } } } = response
                    if (status) {
                        this.$q.notify({
                            color: 'positive',
                            position: 'top-right',
                            message: msg,
                            icon: 'check_circle'
                        })
                        this.editCustomerModal = false
                        this.resetForm()
                        if (this.customer) {
                            let index = this.customers.data.findIndex(cust => cust.id === this.customer.id)
                            this.$set(this.customers.data, index, customer)
                        } else {
                            this.customers.total++
                            this.customers.data.unshift(customer)
                        }
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

            resetForm () {
                this.form.name = ''
                this.form.phone = ''
                this.form.email = ''
                this.form.address = ''
                this.form.city = ''
                this.form.state = ''
                this.form.country_id = null
            }
        }
    }
</script>

<style scoped>
    .title {
        font-size: 18px;
    }
</style>
