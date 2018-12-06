<template>
    <tr>
        <th scope="row">
            <a :href="this.url">
                <button class="btn btn-success btn-sm">
                    <i class="glyphicon glyphicon-pencil">&#x270f;</i>
                </button>
            </a>
        </th>

        <index-property v-for="property in properties" :key="property.id" :model="model" :property="property"></index-property>
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

        props: ['model', 'properties', 'model_type', 'id_property'],

        data() {
            return {
                url: this.getUrl(),
            }
        },

        methods: {
            getUrl() {
                return '/admin/' + this.model_type + '/' + this.model[this.id_property]
            },

            deleteItem() {
                axios.delete(this.url)
                    .then(this.$parent.refresh);
            },
        }
    }
</script>