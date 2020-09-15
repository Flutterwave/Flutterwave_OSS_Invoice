<template>
    <q-layout view="hHh lpR fFf">

        <q-drawer :breakpoint="991" :width="230" bordered
                  id="sidebar" no-swipe-open show-if-above side="left"
                  v-model="drawer">
            <div class="q-mt-xl q-mb-xl text-center">
                <div>
                    <q-img src="~assets/app-logo-128x128.png" width="30px"/>
                    <span class="q-pl-xs"
                          style="letter-spacing: .3px; font-size: 16px; font-weight: normal;">
                        Invoices
                    </span>
                </div>
                <div class="q-mt-xl text-grey text-subtitle2">Welcome, {{ f_name }}</div>
            </div>
            <div>
                <q-list class="q-pt-xl">
                    <q-item to="/invoices">
                        <q-item-section avatar>
                            <q-icon name="receipt"/>
                        </q-item-section>
                        <q-item-section>
                            <q-item-label>Invoices</q-item-label>
                        </q-item-section>
                    </q-item>
                    <q-item to="/clients">
                        <q-item-section avatar>
                            <q-icon name="group"/>
                        </q-item-section>
                        <q-item-section>
                            <q-item-label>Clients</q-item-label>
                        </q-item-section>
                    </q-item>

                </q-list>

                <q-btn @click="logout" label="LOGOUT" size="md"
                       style="margin-top: 130%;margin-bottom: 1em;display: block;
                            margin-left: auto; margin-right: auto; font-size: 12px;" unelevated/>
            </div>

        </q-drawer>

        <q-page-container>
            <q-btn @click="drawer = !drawer" aria-label="Menu"
                   class="q-ml-sm q-mt-sm" dense flat
                   round style="font-size: 12px">
                <q-icon name="menu"/>
            </q-btn>

            <transition :duration="500" enter-active-class="animated fadeIn" leave-active-class="animated fadeOut"
                        mode="out-in">
                <keep-alive :max="50">
                    <router-view :key="$route.fullPath"/>
                </keep-alive>
            </transition>

            <q-page-scroller :duration="200" :offset="[30, 30]" :scroll-offset="300" position="bottom-right">
                <q-btn color="primary" icon="keyboard_arrow_up" round size="sm"/>
            </q-page-scroller>
        </q-page-container>
    </q-layout>
</template>

<script>
    import { mapActions, mapGetters } from 'vuex'
    import FooterLayout from '../global/FooterLayout'

    export default {
        name: 'AdminLayout',
        components: {
            FooterLayout
        },
        computed: {
            ...mapGetters('auth', ['f_name'])
        },
        methods: {
            ...mapActions('auth', ['logout'])
        },
        data () {
            return {
                drawer: false
            }
        }
    }
</script>

<style scoped>

    .q-layout >>> .q-drawer {
        background: #21232f !important;
        color: #b3b9b7 !important;
        font-size: 16px;
    }

    .q-expansion-item >>> .q-icon,
    .q-item >>> .q-icon {
        font-size: .8em;
    }

    .q-expansion-item >>> .q-expansion-item__content {
        margin-left: 10px;
    }

    .q-list .q-item {
        min-height: 58px;
    }

    .q-item.q-router-link--active {
        /*background: #003f5b;*/
        color: #ffd529;
    }
</style>
