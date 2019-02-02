<template>
    <tr>
        <td :class="'model-prop-' + model.id" scope="row">
            <button class="btn btn-success btn-sm" type="button" v-on:click="this.editItem">
                <i class="glyphicon glyphicon-pencil">&#x270f;</i>
            </button>
        </td>
        <toggle-status
            :model="model"
            :model_type="'menuItems'">
        </toggle-status>
        <td scope="row">
            <change-number
                :field="'menuItem-' + model.id"
                :value="model.position"
                :forIndex="'for-index'"
                :model_type="'menuItems'"
                :model="this.model"
                :model_property="'position'">
            </change-number>
        </td>
        <td :class="'model-prop-' + model.id">{{ model.title }} </td>
        <td v-if="model.child_menu != null">
            <button class="btn btn-success btn-sm"  type="button">
                <a class="edit-nested-menu" :href="'/admin/menus/' + model.child_menu.id">
                    {{ this.$parent.labels['edit_nested_menu'] }}
                </a>
            </button>
        </td>
        <td v-else="model.child_menu != null">
            <button class="btn btn-success btn-sm"  type="button">
                <a class="edit-nested-menu" :href="'/admin/menus/create'">
                    {{ this.$parent.labels['add_nested_menu'] }}
                </a>
            </button>
        </td>
        <td :class="'model-prop-' + model.id">
            <button class="btn btn-danger btn-sm"  type="button" v-on:click="this.deleteItem">
                <span aria-hidden="true">&times;</span>
            </button>
        </td>
        <!--<edit-menu-item-->
            <!--v-if="this.editing"-->
            <!--:item="this.$parent.item"-->
            <!--:model="model">-->
        <!--</edit-menu-item>-->
    </tr>
</template>

<script>
    import EditMenuItem from "./EditMenuItem";
    import ToggleStatus from "./ToggleStatus";
    import ChangeNumber from "./ChangeNumber";

    export default {
        components: {EditMenuItem, ToggleStatus, ChangeNumber},

        props: [
            'model'
        ],

        data() {
            return {
                editing: false,
                position: this.model.position,
            }
        },

        watch: {
            editing: function () {
                if (this.editing) {
                    $('.model-prop-' + this.model.id).hide();
                } else {
                    $('.model-prop-' + this.model.id).show();
                }
            },

            position: function (position) {
                let index = this.$parent.items.map(e => e.id).indexOf(this.model.id);
                this.$parent.items[index].position = position;
                this.$parent.orderByPosition();
            }
        },

        methods: {
            deleteItem() {
                axios.delete('/admin/menu-items/' + this.model.id)
                    .then(data => {
                        this.$parent.$data.dataMenuItems = data.data.models;
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

    .edit-nested-menu, .edit-nested-menu:hover {
        text-decoration: none;
        color: white;
    }
</style>