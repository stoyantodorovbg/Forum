<template>
    <div>
        <button class="btn btn-success" v-on:click="displayInputs()" type="button">
            {{ labels['add_a_translation'] }}
        </button>
        <div v-if="this.addingTranslation">
            <div class="form-group">
                <label class="col-form-label">{{ labels['language'] }}</label>
                <select class="form-control translation-language-id">
                    <option
                        v-for="language in languages"
                        v-if="language.id !== label.default_language_id &&
                        !labelLanguages.includes(language.title)"
                        v-model="selected"
                        :value="language.id">
                        {{ language.title }}
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label class="col-form-label">{{ labels['body'] }}</label>
                <div>
                    <input class="form-control translation-content">
                </div>
            </div>
            <button class="btn btn-success" id="saveTranslation" type="button" v-on:click="addTranslation()">
                {{ labels['save_translation'] }}
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['languages', 'label', 'labels'],

        data() {
            return {
                selected: this.isDefaultLanguage(this.languages, this.label),
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
            isDefaultLanguage(language, label) {
                if(language.id !== label.default_language_id) {
                    return '';
                }

                return 'selected';
            },

            displayInputs() {
                this.addingTranslation = true;
            },

            addTranslation() {
                axios.post('/admin/label-translations/store', {
                    label_id: this.label.id,
                    language_id: $('.translation-language-id').val(),
                    content: $('.translation-content').val(),
                }).then(data => {
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