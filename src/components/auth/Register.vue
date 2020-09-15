<template>
    <div>
        <p class="text-center q-mb-sm auth-title">
            Register to create invoices
        </p>
        <q-card class="card no-shadow">
            <q-card-section>
                <q-form class="q-py-sm">
                    <div class="">
                        <div class="q-pb-sm">First Name</div>
                        <q-input
                            :hint="errors.first('first name')"
                            name="first name"
                            class="bg-white auth"
                            outlined
                            placeholder="First Name"
                            type="text"
                            v-model="form.f_name"
                            v-validate="'required'">
                        </q-input>
                    </div>
                    <div class="q-mt-md">
                        <div class="q-pb-sm">Last Name</div>
                        <q-input
                            :hint="errors.first('last name')"
                            name="last name"
                            class="bg-white auth"
                            outlined
                            placeholder="Last Name"
                            type="text"
                            v-model="form.l_name"
                            v-validate="'required'">
                        </q-input>
                    </div>
                    <div class="q-mt-md">
                        <div class="q-pb-sm">Phone</div>
                        <q-input
                            :hint="errors.first('phone')"
                            name="phone"
                            class="bg-white auth"
                            outlined
                            placeholder="Phone"
                            type="text"
                            v-model="form.phone">
                        </q-input>
                    </div>
                    <div class="q-mt-md">
                        <div class="q-pb-sm">Country</div>
                        <q-select :hint="errors.first('country')"
                                  name="country"
                                  @filter="filterFn"
                                  input-debounce="200"
                                  bg-color="white"
                                  outlined use-input
                                  hide-selected fill-input
                                  :options="countries_options"
                                  dense emit-value map-options
                                  v-model="form.country"
                                  v-validate="'required'"
                        />
                    </div>
                    <div class="q-mt-md">
                        <div class="q-pb-sm">Email Address</div>
                        <q-input
                            :hint="errors.first('email')"
                            name="email"
                            class="bg-white auth"
                            outlined
                            placeholder="Email"
                            type="text"
                            v-model="form.email"
                            v-validate="'required|email'">
                        </q-input>
                    </div>

                    <div class="q-mt-md">
                        <div class="q-pb-sm">Password</div>
                        <q-input
                            :hint="errors.first('password')"
                            name="password"
                            outlined
                            :type="isPwd ? 'password' : 'text'"
                            class="bg-white auth auth"
                            ref="password"
                            placeholder="Password"
                            v-model="form.password"
                            v-validate="'required|min:4'">
                            <template v-slot:append>
                                <q-icon
                                    :name="isPwd ? 'visibility_off' : 'visibility'"
                                    class="cursor-pointer"
                                    @click="isPwd = !isPwd"
                                />
                            </template>
                        </q-input>
                    </div>
                    <div class="q-mt-md">
                        <div class="q-pb-sm">Confirm Password</div>
                        <q-input :hint="errors.first('confirm password')"
                                 bg-color="white" dense
                                 error-message="The password confirmation does not match "
                                 placeholder="Confirm Password" name="confirm password" outlined
                                 :type="isPwd ? 'password' : 'text'"
                                 v-model="form.password_confirmation"
                                 v-validate="'required|confirmed:password|min:4'">
                            <template v-slot:append>
                                <q-icon
                                    :name="isPwd ? 'visibility_off' : 'visibility'"
                                    class="cursor-pointer"
                                    @click="isPwd = !isPwd"
                                />
                            </template>
                        </q-input>
                    </div>


                    <div class="text-center q-mt-md">
                        <q-btn
                            @click="register"
                            class="q-mt-md full-width text-bold"
                            label="Register"
                            no-caps
                            style="height: 50px; border-radius: 4px; background-color: #F5A623"
                            text-color="white"
                            unelevated
                        />

                    </div>

                    <div class="q-mt-md">
                        <q-btn @click="gotoLogin" flat dense color="primary q-pr-none"
                               no-caps icon="arrow_back" label="Back to login"/>
                    </div>
                </q-form>
            </q-card-section>
        </q-card>
    </div>
</template>

<script>

    import { AuthService } from '../../services/AuthService'
    import { mapActions, mapGetters } from 'vuex'
    import { mapFields } from 'vuex-map-fields'
    import { UtilService } from '../../services/UtilService'

    let countriesData = []

    export default {
        name: 'Register',
        data () {
            return {
                loading: false,
                isPwd: true,
                form: {
                    f_name: '',
                    l_name: '',
                    phone: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    country: null
                },
                countries_options: null,
                form_rules: {
                    username: 'required|max:50',
                    password: 'required|min:8',
                    grant_type: 'required'
                }
            }
        },
        computed: {
            ...mapGetters('auth', ['isAuth']),
            ...mapFields('auth', ['comp'])
        },
        created () {
            this.fetchCountries()
        },
        methods: {
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
            async register () {
                const valid = await this.$validator.validateAll()
                if (valid) {
                    this.loading = true
                    // await AuthService.getCookie()
                    const response = await AuthService.registerUser(this.form)
                    if (response.data.status) {

                        this.$q.notify({
                            color: 'positive',
                            icon: 'done',
                            message: response.data.msg,
                            position: 'top-right'
                        })
                        // this.resetForm()
                        this.gotoLogin()

                    } else {
                        this.$q.notify({
                            color: 'negative',
                            icon: 'cancel',
                            message: response.data.msg,
                            position: 'top-right'
                        })
                    }
                    this.loading = false
                }
            },
            gotoLogin () {
                this.comp = 'login'
            },
            resetForm () {
                this.form = {}
            },
            ...mapActions('auth', ['setAuthStatus', 'setUserData']),
        }
    }
</script>

<style scoped>
    .q-field--outlined >>> .q-field__bottom {
        background: #F4F6F8;
    }
</style>
