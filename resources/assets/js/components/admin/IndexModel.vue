<template>
    <tr>
        <td scope="row">
            <a :href="this.url">
                <button class="btn btn-success btn-sm edit-item">
                    <i class="glyphicon glyphicon-pencil">&#x270f;</i>
                </button>
            </a>
        </td>
        <td scope="row">
        <label class="switch">
            <input type="checkbox" @change="toggleStatus" :checked="this.model.status">
            <span class="slider round"></span>
        </label>
        </td>
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

    export default {
        components: {IndexProperty},

        props: [
            'model',
        ],

        data() {
            return {
                url: this.getUrl(),
            }
        },

        methods: {
            getUrl() {
                return '/admin/' + this.$parent.model_type + '/' + this.model[this.$parent.id_property]
            },

            deleteItem() {
                axios.delete(this.url)
                    .then(this.$parent.refresh)
                    .then(flash('Deleted.'))
                    .catch(error => {
                        flash(error.response.data, 'danger');
                    });
            },

            toggleStatus() {
                axios.post('/admin/model-status', {
                    model_type: this.$parent.model_type,
                    model_id: this.model.id,
                }).then()
            },
        }
    }
</script>

<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 30px;
        height: 17px;
        margin-top: 4px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 11px;
        width: 11px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #28a745;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #28a745;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(13px);
        -ms-transform: translateX(13px);
        transform: translateX(13px);
    }

    .slider.round {
        border-radius: 17px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

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