<template>
    <q-page class="q-pt-md q-px-xl q-pb-xl ">
        <PageHeader
            header="Customers"
            subheader="Create and manage your customers here"/>

        <div class="q-gutter-y-md">
            <div class="q-pb-xl q-pt-lg">
                <router-view :key="$route.fullPath"/>
            </div>
        </div>



    </q-page>
</template>

<script>

    import PageHeader from '../../components/PageHeader'
    export default {
        name: 'Clients',
        components: { PageHeader },
        meta () {
            return {
                title: 'Clients - Invoices'
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
