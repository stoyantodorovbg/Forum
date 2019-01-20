<template>
    <div>
        <button v-if="!addingTranslation" class="btn btn-success" v-on:click="displayInputs()" type="button">
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
            <input-text v-for="input in this.$parent.text_input_labels"
                        :label="input[0]"
                        :field="input[1]"
                        :key="input.id"></input-text>
            <input-textarea v-for="input in this.$parent.textarea_input_labels"
                        :label="input[0]"
                        :field="input[1]"
                        :key="input.id"></input-textarea>
            <button class="btn btn-success" id="saveTranslation" type="button" v-on:click="addTranslation()">
                {{ this.$parent.labels['save_translation'] }}
            </button>
            <button class="btn btn-info" type="button" @click="cancel">
                {{ this.$parent.labels['cancel'] }}
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
                axios.post(this.$parent.url + 'store', this.getData()).then(data => {
                    this.$parent.$data.dataTranslations = data.data.translations;
                    flash('Translation added.');
                }).catch(function () {
                    flash('Something went wrong.');
                });
                this.addingTranslation = false;
            },

            getData() {
                let data = {
                    language_id: $('.translation-language-id').val(),
                };

                let item_id = this.$parent.item_name + '_id';
                data[item_id] = this.item.id;

                if (typeof this.$parent.text_inputs !== 'undefined') {
                    for (let input of this.$parent.text_inputs) {
                        data[input] = $('#translation-' + input).val();
                    }
                }

                if(typeof this.$parent.textarea_inputs !== 'undefined') {
                    for (let input of this.$parent.textarea_inputs) {
                        data[input] = $('#translation-' + input).val();
                    }
                }

                return data;
            },

            cancel() {
                this.addingTranslation = false;
            }
        }
    }
</script>

<style>
    .alert-flash {
        bottom: 43px;
    }
</style>