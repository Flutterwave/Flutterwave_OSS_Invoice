<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Reset Password</div>

                    <div class="card-body pt-4">
                        <div class="text-center" v-if="!show_form">
                            {{message}}
                        </div>

                        <div v-else>
                            <div class="text-center mb-3" style="color: red;" v-if="error">
                                {{message}}
                            </div>
                            <div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right" for="password">
                                        Password</label>

                                    <div class="col-md-6">
                                        <input autocomplete="new-password" autofocus class="form-control"
                                               id="password"
                                               name="password" required type="password" v-model="form.password">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right" for="password-confirm">
                                        Confirm Password</label>

                                    <div class="col-md-6">
                                        <input autocomplete="new-password" class="form-control"
                                               id="password-confirm"
                                               name="password_confirmation" required type="password"
                                               v-model="form.password_confirmation">
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button :disabled="isProcessing" @click="doReset" class="btn text-white"
                                                style="background-color: #88B15E">
                                            Reset Password
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="module">

    export default {
        name: 'ChangePassword',
        props: ['reset_token', 'user_email'],
        data () {
            return {
                form: {
                    password: '',
                    password_confirmation: '',
                    email: this.user_email,
                    token: this.reset_token
                },
                error: false,
                message: '',
                show_form: true,
                isProcessing: false
            }
        },
        methods: {
            async doReset () {
                this.isProcessing = true
                this.error = false
                this.message = ''
                try {
                    const response = await axios.post('/api/auth/updatePassword', this.form)
                    if (response.data.status) {
                        this.show_form = false
                        this.message = 'Password reset successfully'
                    } else {
                        if (response.data.meta === 'validation_error') {
                            this.error = true
                            this.message = response.data.error
                            this.resetForm()
                        } else if (response.data.meta === 'invalid_token') {
                            this.show_form = false
                            this.message = 'Invalid token'
                        }
                    }
                } catch (error) {
                    console.error(error)
                } finally {
                    this.isProcessing = false
                }
            },
            resetForm () {
                this.form.password = ''
                this.form.password_confirmation = ''
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
        background-color: #88B15E;
    }

    .q-field >>> .q-field__bottom .q-field__messages {
        font-size: 12px;
    }

</style>
