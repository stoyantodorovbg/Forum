<template>
    <tr>
        <td>{{ translation.language.title }} </td>
        <td>{{ translation.content }}</td>
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
                axios.delete('/admin/label-translations/' + this.translation.id)
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