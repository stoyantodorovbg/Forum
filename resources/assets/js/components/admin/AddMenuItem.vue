<template>
    <div>
        <button v-if="!addingMenuItem" class="btn btn-success" v-on:click="displayInputs()" type="button">
            {{ this.$parent.labels['add_a_menuItem'] }}
        </button>
        <div v-if="this.addingMenuItem">
            <div class="form-group">
                <label class="col-form-label">{{ this.$parent.labels['language'] }}</label>
                <select class="form-control menuItem-language-id">
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
            <button class="btn btn-success" id="saveMenuItem" type="button" v-on:click="addMenuItem()">
                {{ this.$parent.labels['save_menuItem'] }}
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
                addingMenuItem: false,
            }
        },

        computed: {
            labelLanguages: function () {
                let languages = [];
                for (let menuItem of this.$parent.menuItems) {
                    languages.push(menuItem.language.title)
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
                this.addingMenuItem = true;
            },

            addMenuItem() {
                axios.post(this.$parent.url + 'store', this.getData()).then(data => {
                    this.$parent.$data.dataMenuItems = data.data.menuItems;
                    flash('Menu item added.');
                }).catch(function () {
                    flash('Something went wrong.');
                });
                this.addingMenuItem = false;
            },

            getData() {
                let data = {
                    language_id: $('.menuItem-language-id').val(),
                };

                let item_id = this.$parent.item_name + '_id';
                data[item_id] = this.item.id;

                if (typeof this.$parent.text_inputs !== 'undefined') {
                    for (let input of this.$parent.text_inputs) {
                        data[input] = $('#menuItem-' + input).val();
                    }
                }

                if(typeof this.$parent.textarea_inputs !== 'undefined') {
                    for (let input of this.$parent.textarea_inputs) {
                        data[input] = $('#menuItem-' + input).val();
                    }
                }

                return data;
            },

            cancel() {
                this.addingMenuItem = false;
                flash('Adding menuItem canceled.');
            }
        }
    }
</script>

<style>
    .alert-flash {
        bottom: 43px;
    }
</style>