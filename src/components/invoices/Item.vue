<template>
    <div class="row q-gutter-md no-wrap q-py-sm">
        <div class="col-4">
            <q-input :hint="errors.first('title')" name="title" outlined
                     placeholder="Title" v-model="form.items[id].title"
                     v-validate="'required'"/>
        </div>
        <div class="col-2">
            <q-input :hint="errors.first('quantity')" name="quantity" dense outlined type="number"
                     placeholder="Quantity" v-model="form.items[id].quantity"
                     v-validate="'required|integer'"/>
        </div>
        <div class="col-2">
            <q-input :hint="errors.first('price')" name="price" dense outlined type="number"
                     placeholder="Price" v-model="form.items[id].unit_price"
                     v-validate="'required'"/>
        </div>
        <div class="col-2 text-right">
            <div class="column justify-center" style="height: 50px;">
                <div>
                    {{form.currency}} {{form.items[id].quantity * form.items[id].unit_price | formatAmount}}
                </div>
            </div>
        </div>

        <div class="col-1"v-show="show_close">
            <div class="column justify-center items-center" style="height: 50px;">
                <q-btn  @click="removeItem"  size="sm" flat unelevated icon="remove_circle" color="red-10"/>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapFields} from 'vuex-map-fields'

    export default {
        name: 'Item',
        props: ['closeable', 'id'],
        data() {
            return {
                visible: false,
                show_close: this.closeable
            }
        },
        created () {
            console.log(this.id)
        },
        computed: {
            ...mapFields("invoices", ['form'])
        },
        methods: {
            removeItem() {
                this.form.items.splice(this.id, 1)
            }
        }
    }
</script>

<style scoped>

</style>
