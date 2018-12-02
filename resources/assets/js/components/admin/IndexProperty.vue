<template>
    <td v-text="propertyValue"></td>
</template>

<script>
    export default {
        props: ['model', 'property'],

        data() {
            return {
                propertyValue: this.getPropertyValue(),
            }
        },

        methods: {
            getPropertyValue() {
                let propertyArr = this.property.split('.');
                let result = this.model;

                for (let prop of propertyArr) {
                    result = result[prop];
                }

                return result;
            }
        }
    }
</script>