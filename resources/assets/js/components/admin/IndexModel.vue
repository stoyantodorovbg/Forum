<template>
    <tr>
        <td scope="row">
            <a :href="this.url">
                <button class="btn btn-success btn-sm">
                    <i class="glyphicon glyphicon-pencil">&#x270f;</i>
                </button>
            </a>
        </td>

        <index-property
            v-for="property in this.$parent.properties"
            :key="property.id"
            :property="property">
        </index-property>
        <td>
            <button class="btn btn-danger btn-sm" v-on:click="this.deleteItem">
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
            'model'
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
        }
    }
</script>