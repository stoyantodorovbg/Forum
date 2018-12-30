<template>
    <tr>
        <td scope="row">
            <a href="#">
                <button class="btn btn-success btn-sm">
                    <i class="glyphicon glyphicon-pencil">&#x270f;</i>
                </button>
            </a>
        </td>
        <td>{{ translation.language.title }} </td>
        <td v-for="property in this.$parent.text_inputs">{{ translation[property] }}</td>
        <td>
            <button class="btn btn-danger btn-sm"  type="button" v-on:click="this.deleteItem">
                <span aria-hidden="true">&times;</span>
            </button>
        </td>
    </tr>
</template>

<script>
    export default {
        props: ['translation'],

        methods: {
            deleteItem() {
                axios.delete(this.$parent.url + this.translation.id)
                    .then(data => {
                    this.$parent.$data.dataTranslations = data.data.translations;
                    flash('Deleted.');
                    })
            .catch(error => {
                    flash(error.response.data, 'danger');
                });
            },
        },
    }
</script>

<style>
    .alert-flash {
        bottom: 43px;
    }
</style>