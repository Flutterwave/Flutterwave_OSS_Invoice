<template>
    <div>
        <p class="text-center q-mb-sm auth-title">
            Login to your Dashboard
        </p>
        <q-card class="card no-shadow">
            <q-card-section>
                <q-form class="q-py-sm">
                    <div class="">
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
                            class="bg-white auth"
                            placeholder="Password"
                            v-model="form.password"
                            v-validate="'required'">
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
                        <q-btn  @click="gotoPasswordReset" flat color="primary q-pr-none"
                               no-caps label="Forgot your Password?"/>
                    </div>

                    <div class="text-center">
                        <q-btn
                            @click="login"
                            class="q-mt-md full-width text-bold"
                            label="Login"
                            no-caps
                            style="height: 50px; border-radius: 4px; background-color: #F5A623"
                            text-color="white"
                            unelevated
                            :loading="loading"
                        />

                    </div>

                    <div class="q-mt-md">
                        Don't have an account?
                        <q-btn @click="gotoRegister" flat dense color="primary q-pr-none" no-caps label="Sign up"/>
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

    export default {
        name: 'Login',
        data() {
            return {
                loading: false,
                isPwd: true,
                form: {
                    email: '',
                    password: ''
                },
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
        methods: {
            async login () {
                const valid = await this.$validator.validateAll()
                if (valid) {
                    this.loading = true
                    await AuthService.getCookie()
                    const response = await AuthService.login(this.form)
                    if (response.data.status) {
                        // this.storeToken(response)
                        this.setAuthStatus(true)
                        this.setUserData(_.get(response, ['data', 'data', 'user'], {}))
                        this.$q.notify({
                            color: 'positive',
                            icon: 'check_circle',
                            message: response.data.msg,
                            position: 'top-right'
                        })
                        let redirect = _.get(this.$route, ['query', 'redirect'])
                        if (redirect) {
                            this.$router.replace(redirect)
                        } else {
                            this.$router.replace('/invoices')
                        }

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
            gotoRegister() {
                this.comp = 'register'
            },
            gotoPasswordReset() {
                this.comp = 'reset'
            },
            ...mapActions('auth', ['setAuthStatus', 'setUserData']),
        },
        beforeRouteEnter (to, from, next) {
            next(vm => {
                if (vm.isAuth) {
                    vm.$router.replace({ name: 'public.index' })
                }
            })
        }
    }
</script>

<style scoped>

</style>
