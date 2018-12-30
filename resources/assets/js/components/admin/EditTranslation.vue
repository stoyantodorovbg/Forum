<template>
    <div v-if="!this.edited">
        <h1>{{ this.$parent.$parent.labels['edit_translation'] }}</h1>
        <div>
            <div class="form-group">
                <label class="col-form-label">{{ this.$parent.$parent.labels['language'] }}</label>
                <select class="form-control translation-language-id">
                    <option
                            v-for="language in this.$parent.$parent.languages"
                            v-if="language.id !== item.default_language_id &&
                        !labelLanguages.includes(language.title)"
                            v-model="selected"
                            :value="language.id">
                        {{ language.title }}
                    </option>
                </select>
            </div>
            <input-text v-for="input in this.$parent.$parent.text_input_labels"
                        :label="input[0]"
                        :field="input[1]"
                        :value="translation[input[1]]"
                        :key="input.id"></input-text>
            <input-textarea v-for="input in this.$parent.$parent.textarea_input_labels"
                            :label="input[0]"
                            :field="input[1]"
                            :value="translation[input[1]]"
                            :key="input.id"></input-textarea>
            <button class="btn btn-success" id="editTranslation" type="button" v-on:click="editTranslation()">
                {{ this.$parent.$parent.labels['edit'] }}
            </button>
        </div>
    </div>
</template>

<script>
    import InputText from "./InputText";
    import InputTextarea from "./InputTextarea";

    export default {
        components: {InputText, InputTextarea},

        props: [
            'item',
        ],

        data() {
            return {
                selected: this.isDefaultLanguage(this.$parent.$parent.languages, this.item),
                translation: this.$parent.translation,
                edited: false,
            }
        },

        computed: {
            labelLanguages: function () {
                let languages = [];
                for (let translation of this.$parent.$parent.translations) {
                    languages.push(translation.language.title)
                }

                return languages;
            },
        },

        methods: {
            isDefaultLanguage(language, item) {
                if(language.id !== item.default_language_id) {
                    return '';
                }

                return 'selected';
            },

            editTranslation() {
                axios.post(this.$parent.$parent.url + this.translation.id, this.getData()).then(data => {
                    this.$parent.$parent.$data.dataTranslations = data.data.translations;
                    this.edited = true;
                    this.$parent.editing = false;
                    flash('Edited.');
                }).catch(error => {
                    flash(error.response.data, 'danger');
                });
            },

            getData() {
                let data = {
                    language_id: $('.translation-language-id').val(),
                };

                let item_id = this.$parent.$parent.item_name + '_id';
                data[item_id] = this.item.id;

                for (let input of this.$parent.$parent.text_inputs) {
                    data[input] = $('#translation-' + input).val();
                }

                for (let input of this.$parent.$parent.textarea_inputs) {
                    data[input] = $('#translation-' + input).val();
                }

                return data;
            },
        }
    }
</script>

<style>
    .alert-flash {
        bottom: 43px;
    }
</style>