<template>
    <div>
        <button class="btn btn-success" v-on:click="displayInputs()" type="button">
            {{ this.$parent.labels['add_a_translation'] }}
        </button>
        <div v-if="this.addingTranslation">
            <div class="form-group">
                <label class="col-form-label">{{ this.$parent.labels['language'] }}</label>
                <select class="form-control translation-language-id">
                    <option
                        v-for="language in this.$parent.languages"
                        v-if="language.id !== item.default_language_id &&
                        !labelLanguages.includes(language.title)"
                        v-model="selected"
                        :value="language.id">
                        {{ language.title }}
                    </option>
                </select>
            </div>
            <input-text v-for="label_name in this.$parent.text_input_labels"
                        :label="label_name"
                        :key="label_name.id"></input-text>
            <input-textarea v-for="label_name in this.$parent.textarea_input_labels"
                            :label="label_name"
                            :key="label_name.id"></input-textarea>
            <button class="btn btn-success" id="saveTranslation" type="button" v-on:click="addTranslation()">
                {{ this.$parent.labels['save_translation'] }}
            </button>
        </div>
    </div>
</template>

<script>
    import InputText from "./InputText";

    export default {
        components: {InputText},

        props: [
            'item',
        ],

        data() {
            return {
                selected: this.isDefaultLanguage(this.$parent.languages, this.item),
                addingTranslation: false,
            }
        },

        computed: {
            labelLanguages: function () {
                let languages = [];
                for (let translation of this.$parent.translations) {
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

            displayInputs() {
                this.addingTranslation = true;
            },

            addTranslation() {
                let data = {
                    language_id: $('.translation-language-id').val(),
                };

                let item_id = this.$parent.item_name + '_id';
                data[item_id] = this.item.id;

                for (let input of this.$parent.text_inputs) {
                    data[input] = $('.translation-' + input).val();
                }

                for (let input of this.$parent.textarea_inputs) {
                    data[input] = $('.translation-' + input).val();
                }

                axios.post(this.$parent.url, data).then(data => {
                    this.$parent.$data.dataTranslations = data.data.translations;
                    flash('Added.');
                }).catch(error => {
                    flash(error.response.data, 'danger');
                });
                this.addingTranslation = false;
            },
        }
    }
</script>

<style>
    .alert-flash {
        bottom: 43px;
    }
</style>