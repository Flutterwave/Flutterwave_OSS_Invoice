<template>
    <q-page class="q-pt-md q-px-xl q-pb-xl ">
        <PageHeader
            header="Invoices"
            subheader="Create and manage your invoices here"/>

        <div class="q-gutter-y-md">
            <div class="q-pb-xl q-pt-lg">
                <router-view :key="$route.fullPath"/>
            </div>
        </div>

        <!--        <div>-->
        <!--            <q-dialog v-model="dialog">-->
        <!--                <q-card style="width: 600px; max-width: 70vw;">-->
        <!--                    <q-card-section>-->
        <!--                        <q-btn class="float-right" flat icon="close" size="sm" v-close-popup/>-->
        <!--                    </q-card-section>-->
        <!--                    <q-card-section>-->
        <!--                        <div>-->
        <!--                            Details-->
        <!--                        </div>-->
        <!--                    </q-card-section>-->
        <!--                </q-card>-->
        <!--            </q-dialog>-->
        <!--        </div>-->

    </q-page>
</template>

<script>

    import PageHeader from '../../components/PageHeader'
    export default {
        name: 'Invoices',
        components: { PageHeader },
        meta () {
            return {
                title: 'Invoices'
            }
        },
        data () {
            return {
                dialog: false,
            }
        },
        computed: {},
        created () {},
        methods: {},
        filters: {}
    }
</script>

<style scoped>

</style>
