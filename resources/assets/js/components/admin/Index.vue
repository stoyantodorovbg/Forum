<template>
    <tbody>
        <index-model
                v-for="model in models"
                :key="model.id"
                :model="model"
                :properties="properties"
                :model_type="model_type">
        </index-model>
        <paginator :dataSet="dataSet" @changed="fetch"></paginator>
    </tbody>
</template>

<script>
    import collection from '../../mixins/collection';

    export default {
        mixins: [collection],

        props: ['models', 'properties', 'model_type'],

        data() {
            return {
                dataSet: false,
            }
        },

        created() {
            this.fetch();
        },

        methods: {
            fetch(page) {
                axios.get(this.url(page))
                    .then(this.refresh);
            },

            url(page) {
                if (! page) {
                    let query = window.location.search.match(/page=(\d+)/);
                    page = query ? query[1] : 1;
                }

                return window.location.pathname + '/index?page=' + page;
            },

            refresh({data}) {
                this.dataSet = data;
                this.models = data.data;
                window.scrollTo(0, 0);
            },
        }
    }
</script>

<style>
    .pagination {
        width: 130%;
    }
</style>