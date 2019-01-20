<template>
    <tr>
        <td :class="'translation-prop-' + translation.id" scope="row">
            <button class="btn btn-success btn-sm" type="button" v-on:click="this.editItem">
                <i class="glyphicon glyphicon-pencil">&#x270f;</i>
            </button>
        </td>
        <td :class="'translation-prop-' + translation.id">{{ translation.language.title }} </td>
        <td :class="'translation-prop-' + translation.id" v-for="property in this.$parent.text_inputs">{{ translation[property] }}"</td>
        <td :class="'translation-prop-' + translation.id">
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

        watch: {
            editing: function () {
                if (this.editing) {
                    $('.translation-prop-' + this.translation.id).hide();
                } else {
                    $('.translation-prop-' + this.translation.id).show();
                }
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