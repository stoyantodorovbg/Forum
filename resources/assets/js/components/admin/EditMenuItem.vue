<template>
    <div v-if="!this.edited">
        <h1>{{ this.$parent.$parent.labels['edit_menuItem'] }}</h1>
        <div>
            <div class="form-group">
                <label class="col-form-label">{{ this.$parent.$parent.labels['language'] }}</label>
                <select class="form-control menuItem-language-id">
                    <option
                        v-for="language in this.$parent.$parent.languages"
                        v-if="language.id !== item.default_language_id &&
                        !labelLanguages.includes(language.title)"
                        v-on:option="isDefaultLanguage(language, item)"
                        :value="language.id">
                        {{ language.title }}
                    </option>
                </select>
            </div>
            <input-text v-for="input in this.$parent.$parent.text_input_labels"
                 :label="input[0]"
                 :field="input[1]"
                 :value="menuItem[input[1]]"
                 :key="input.id"></input-text>
            <input-textarea v-for="input in this.$parent.$parent.textarea_input_labels"
                 :label="input[0]"
                 :field="input[1]"
                 :value="menuItem[input[1]]"
                 :key="input.id"></input-textarea>
            <button class="btn btn-success" id="editTranslation" type="button" v-on:click="editTranslation()">
                {{ this.$parent.$parent.labels['edit'] }}
            </button>
            <button class="btn btn-info" type="button" @click="cancel">
                {{ this.$parent.$parent.labels['cancel'] }}
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
                menuItem: this.$parent.menuItem,
                edited: false,
            }
        },

        computed: {
            labelLanguages: function () {
                let languages = [];
                for (let menuItem of this.$parent.$parent.menuItems) {
                    languages.push(menuItem.language.title)
                }

                return languages;
            },
        },

        methods: {
            isDefaultLanguage(language, item) {
                if(language.id === item.language_id) {
                    return 'selected';
                }

                return '';

                if(language.id !== item.default_language_id) {
                    return '';
                }

                return 'selected';
            },

            editTranslation() {
                axios.post(this.$parent.$parent.url + this.menuItem.id, this.getData()).then(data => {
                    this.$parent.$parent.$data.dataTranslations = data.data.menuItems;
                    this.edited = true;
                    this.$parent.editing = false;
                    flash('Translation edited.');
                }).catch(function () {
                    flash('Something went wrong.');
                });
            },

            getData() {
                let data = {
                    language_id: $('.menuItem-language-id').val(),
                };

                let item_id = this.$parent.$parent.item_name + '_id';
                data[item_id] = this.item.id;

                if (typeof this.$parent.$parent.text_inputs !== 'undefined') {
                    for (let input of this.$parent.$parent.text_inputs) {
                        data[input] = $('#menuItem-' + input).val();
                    }
                }

                if (typeof this.$parent.$parent.textarea_inputs !== 'undefined') {
                    for (let input of this.$parent.$parent.textarea_inputs) {
                        data[input] = $('#menuItem-' + input).val();
                    }
                }

                return data;
            },

            cancel() {
                this.edited = true;
                this.$parent.editing = false;
                flash('Editing menuItem canceled.');
            }
        }
    }
</script>

<style>
    .alert-flash {
        bottom: 43px;
    }
</style>