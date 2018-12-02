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

        props: ['models', 'properties', 'model_type', 'search_props'],

        data() {
            return {
                dataSet: false,
                searchPropsArr: this.getSearchPropsArr(),
            }
        },

        created() {
            this.fetch();
        },

        mounted() {
            this.attachEvents();
        },

        methods: {
            fetch(page) {
                axios.post(this.url(page), this.attachSearchProps())
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

            attachSearchProps() {
                let propsObj = {};
                for (let prop of this.searchPropsArr) {

                    propsObj[prop] = this.getSearchPropValue(prop);
                }

                return propsObj;
            },

            getSearchPropValue(prop) {
                return $('#' + this.model_type + '-' + prop).val();
            },

            getSearchPropsArr() {
                let propsArr = [];
                for (let prop of this.search_props) {
                    let propArr = prop.split('-');
                    let propStr = propArr[1];

                    propsArr.push(propStr);
                }

                return propsArr;
            },

            attachEvents() {
                let component = this;
                for (let prop of this.searchPropsArr) {
                    $('#' + this.model_type + '-' + prop).keyup(function () {
                        component.fetch();
                    });
                }
            }
        }
    }
</script>

<style>
    .pagination {
        width: 130%;
    }
</style>