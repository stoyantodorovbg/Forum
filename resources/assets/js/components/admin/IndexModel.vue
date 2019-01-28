<template>
    <tr>
        <td scope="row">
            <a :href="this.url">
                <button class="btn btn-success btn-sm edit-item">
                    <i class="glyphicon glyphicon-pencil">&#x270f;</i>
                </button>
            </a>
        </td>
        <toggle-status
            v-if="hasStatusInput"
            :model="model"
            :model_type="this.$parent.model_type">
        </toggle-status>
        <index-property
            v-for="property in this.$parent.properties"
            :key="property.id"
            :property="property">
        </index-property>
        <td v-if="$parent.delitable">
            <button class="btn btn-danger btn-sm remove-item" v-on:click="this.deleteItem">
                <span aria-hidden="true">&times;</span>
            </button>
        </td>
    </tr>
</template>
<script>
    import IndexProperty from "./IndexProperty";
    import ToggleStatus from "./ToggleStatus";

    export default {
        components: {IndexProperty, ToggleStatus},

        props: [
            'model',
        ],

        data() {
            return {
                url: this.getUrl(),
                hasStatusInput: this.hasStatusProperty(),
            }
        },

        methods: {
            getUrl() {
                return '/admin/' + this.$parent.model_type + '/' + this.model[this.$parent.id_property]
            },

            deleteItem() {
                axios.delete(this.url)
                    .then(this.$parent.refresh)
                    .then(flash('Item deleted.'))
                    .catch(function () {
                        flash('Something went wrong.');
                    });
            },

            hasStatusProperty() {
                if(this.model.hasOwnProperty('status')) {
                    return true;
                }

                return false;
            },
        }
    }
</script>

<style>
    .table-sm td {
        padding-bottom: 0;
    }

    .remove-item, .edit-item {
        padding-top: 3px;
        height: 26px;
    }

    .edit-item {
        width: 26px;
    }
</style>