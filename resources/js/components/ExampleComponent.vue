<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        name: 'password-reset',
        props: ['meta'],
        data () {
            return {
                form: {
                    email: '',
                    password: '',
                    password_confirmation: ''
                }
            }
        },
        methods: {
            doReset () {
                this.$validator.validateAll().then(async function (valid) {
                    if (valid) {
                        try {
                            const response = await axios.post('/forgot-password', this.form)
                            if (response.data.status) {
                                this.$q.notify({
                                    position: 'top-right',
                                    icon: 'done',
                                    color: 'positive',
                                    message: 'Login successful'
                                })
                                y

                                // this.$router.replace(redirect);

                            } else {
                                console.error(response.data)
                            }
                        } catch (error) {
                            console.error(error)
                        }
                    }
                }.bind(this))
            },
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
