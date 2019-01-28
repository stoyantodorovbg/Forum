<template>
    <tr>
        <td :class="'menuItem-prop-' + menuItem.id" scope="row">
            <button class="btn btn-success btn-sm" type="button" v-on:click="this.editItem">
                <i class="glyphicon glyphicon-pencil">&#x270f;</i>
            </button>
        </td>
        <toggle-status
            :model="menuItem"
            :model_type="'menuItems'">
        </toggle-status>
        <td scope="row">
            <input-number
                :field="'menuItem-' + menuItem.id"
                :value="menuItem.value"
                :forIndex="'for-index'">
            </input-number>
        </td>
        <td :class="'menuItem-prop-' + menuItem.id">{{ menuItem.title }} </td>
        <td :class="'menuItem-prop-' + menuItem.id">
            <button class="btn btn-danger btn-sm"  type="button" v-on:click="this.deleteItem">
                <span aria-hidden="true">&times;</span>
            </button>
        </td>
        <!--<edit-menu-item-->
            <!--v-if="this.editing"-->
            <!--:item="this.$parent.item"-->
            <!--:menuItem="menuItem">-->
        <!--</edit-menu-item>-->
    </tr>
</template>

<script>
    import EditMenuItem from "./EditMenuItem";
    import ToggleStatus from "./ToggleStatus";
    import InputNumber from "./InputNumber";

    export default {
        components: {EditMenuItem, ToggleStatus, InputNumber},

        props: [
            'menuItem'
        ],

        data() {
            return {
                editing: false,
            }
        },

        watch: {
            editing: function () {
                if (this.editing) {
                    $('.menuItem-prop-' + this.menuItem.id).hide();
                } else {
                    $('.menuItem-prop-' + this.menuItem.id).show();
                }
            }
        },

        methods: {
            deleteItem() {
                axios.delete(this.$parent.url + this.menuItem.id)
                    .then(data => {
                        this.$parent.$data.dataMenuItems = data.data.menuItems;
                        flash('Menu item deleted.');
                    }).catch(function () {
                    flash('Something went wrong.');
                });
            },

            editItem() {
                this.editing = true;
            },
        },
    }
</script>

<style>
    .alert-flash {
        bottom: 43px;
    }
</style>