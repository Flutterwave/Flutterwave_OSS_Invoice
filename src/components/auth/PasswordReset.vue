<template>
    <div>
        <p class="text-center q-mb-sm auth-title">
            Reset Password
        </p>
        <div class="text-center q-pb-md">
            A mail containing the password reset link will be sent to the email provided below.
            Please check spam folder if not found in your inbox
        </div>
        <q-card class="card no-shadow">
            <q-card-section>
                <q-form class="q-py-sm">
                    <div class="">
                        <div class="q-pb-sm">Email</div>
                        <q-input
                            :hint="errors.first('email')"
                            class="bg-white auth"
                            name="email"
                            ref="email"
                            outlined
                            placeholder="Enter registered email"
                            type="text"
                            v-model="form.email"
                            v-validate="'required|email'">
                        </q-input>
                    </div>

                    <div class="text-center q-mt-md">
                        <q-btn
                            @click="doReset"
                            class="q-mt-md full-width text-bold"
                            label="Reset Password"
                            no-caps
                            style="height: 50px; border-radius: 4px; background-color: #F5A623"
                            text-color="white"
                            unelevated
                        />

                    </div>

                    <div class="q-mt-md">
                        <q-btn @click="gotoLogin" color="primary q-pr-none" dense flat
                               icon="arrow_back" label="Back to login" no-caps/>
                    </div>
                </q-form>
            </q-card-section>
        </q-card>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    import { mapFields } from 'vuex-map-fields'

    export default {
        name: 'PasswordReset',
        props: ['meta'],
        data () {
            return {
                form: {
                    email: ''
                }
            }
        },
        computed: {
            ...mapGetters('auth', ['isAuth', 'comp']),
            ...mapFields('auth', ['comp'])
        },
        methods: {
            async doReset () {
                const valid = await this.$validator.validateAll()
                if (valid) {
                    const response = await this.$axios.post('auth/resetPassword', this.form)
                    const { data: { status, msg, data } } = response
                    if (status) {
                        this.$q.notify({
                            position: 'top-right',
                            icon: 'check_circle',
                            color: 'positive',
                            message: msg
                        })

                        this.gotoLogin()

                    } else {
                        this.$q.notify({
                            position: 'top-right',
                            icon: 'cancel',
                            color: 'negative',
                            message: msg
                        })
                    }

                }
            },

            gotoLogin () {
                this.comp = 'login'
            },
            formReset () {
                this.form.email = ''
                this.$refs.email.resetValidation()
            }
        }
    }
</script>

<style scoped type="text/css">

    .authentication-theme.auth-style_1 {
        height: 100%;
        min-height: 100vh;
        width: 100%;
    }

    .authentication-theme.auth-style_1 {
        height: 100vh;
        width: 100vw;
        background: linear-gradient(20deg, #f24616, #eba05e 40%, white 20%, white);
    }

    .q-field >>> .q-field__bottom .q-field__messages {
        font-size: 12px;
    }

</style>
