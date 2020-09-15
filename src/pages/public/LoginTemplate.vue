<template>
    <q-page class="image-background">
        <div class="row justify-center">
            <div class="col-6" style="max-width: 450px">
                <div class="text-center no-wrap" style="margin-top: 20%; margin-bottom: 10%">
                    <q-img
                        spinner-color="white"
                        src="app-logo-128x128.png"
                        style="height: 35px; max-width: 35px"
                    />
                    <span class="q-pl-xs"
                          style="letter-spacing: .4px; font-size: 20px; font-weight: normal;">
                        Invoices
                    </span>
                </div>
                <transition name="fade" tag="div"  mode="out-in">
                    <Login v-if="to_login"/>
                    <Register v-else/>
                </transition>
<!--                <transition appear name="fade" tag="div">-->
<!--                    -->
<!--                </transition>-->

            </div>
        </div>
    </q-page>
</template>

<script>
    import Login from '../../components/auth/Login'

    import { mapFields } from 'vuex-map-fields'
    import Register from '../../components/auth/Register'

    export default {
        name: 'LoginTemplate',
        components: { Register, Login },
        data () {
            return {}
        },
        computed: {
            ...mapFields('auth', ['to_login'])
        },
        methods: {}
    }
</script>

<style scoped>
    .image-background {
        background: #F4F6F8;
        color: #212b36;
        font-size: 14px;
    }
</style>

<style>
    .card {
        padding: 0 5% 5%;
        background: transparent;
        border: none;
    }

    .auth-title {
        font-weight: bold;
        font-size: 1.6em;
        letter-spacing: 2px;
    }
</style>
