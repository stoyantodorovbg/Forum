<template>
    <tr>
        <td v-if="!this.editing" scope="row">
            <button class="btn btn-success btn-sm" type="button" v-on:click="this.editItem">
                <i class="glyphicon glyphicon-pencil">&#x270f;</i>
            </button>
        </td>
        <td v-if="!this.editing">{{ translation.language.title }} </td>
        <div v-if="!this.editing">
            <td v-for="property in this.$parent.text_inputs">{{ translation[property] }}"</td>
        </div>
        <td v-if="!this.editing">
            <button class="btn btn-danger btn-sm"  type="button" v-on:click="this.deleteItem">
                <span aria-hidden="true">&times;</span>
            </button>
        </td>
        <edit-translation
                v-if="this.editing"
                :item="this.$parent.item"
                :translation="translation"
        ></edit-translation>
    </tr>
</template>

<script>
    import EditTranslation from "./EditTranslation";

    export default {
        components: {EditTranslation},

        props: [
            'translation'
        ],

        data() {
            return {
                editing: false,
            }
        },

        methods: {
            deleteItem() {
                axios.delete(this.$parent.url + this.translation.id)
                    .then(data => {
                    this.$parent.$data.dataTranslations = data.data.translations;
                    flash('Translation deleted.');
                    }).catch(function () {
                        flash('Something went wrong.');
                    });
            },

            editItem() {
                this.editing = true;
            }
        },
    }
</script>

<style>
    .alert-flash {
        bottom: 43px;
    }
</style>