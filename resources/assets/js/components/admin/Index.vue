<template>
    <tbody>
        <index-model
            v-for="model in dataModels"
            :key="model.id"
            :model="model">
        </index-model>
        <paginator :dataSet="dataSet" @changed="fetch"></paginator>
    </tbody>
</template>

<script>
    import collection from '../../mixins/collection';
    import IndexModel from "./IndexModel";

    export default {
        mixins: [collection],
        components: {IndexModel},

        props: [
            'properties',
            'model_type',
            'search_props',
            'id_property',
            'delitable',
        ],

        data() {
            return {
                dataSet: false,
                searchPropsArr: this.getSearchPropsArr(),
                dataModels: [],
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
                this.dataModels = data.data;
                window.scrollTo(0, 0);
            },

            attachSearchProps() {
                let propsObj = {};
                for (let prop of this.searchPropsArr) {
                    if(prop != 'created_at' && prop != 'updated_at') {
                        propsObj[prop] = this.getSearchPropValue(prop);
                    } else {
                        propsObj[prop  + '_from'] = this.getSearchPropValue(prop  + '_from');
                        propsObj[prop  + '_to'] = this.getSearchPropValue(prop  + '_to');
                    }
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

                $('.admin-search-text').keyup(function () {
                    component.fetch();
                });

                $('.admin-search-bool, .admin-search-option, .admin-search-date').change(function () {
                    component.fetch();
                });
            }
        }
    }
</script>

<style>
    .pagination {
        width: 130%;
    }

    .admin-search-label {
        margin: 10px 0 0 0 !important;
    }
</style>