<template>
    <div v-if="!this.edited">
        <h1>{{ this.$parent.$parent.labels['editing_menu_item'] }}</h1>
        <div>
            <input-text
                :label="this.$parent.$parent.labels.title"
                :field="'menu-item-title'"
                :value="this.$parent.model.title">
            </input-text>
            <input-text
                :label="this.$parent.$parent.labels.link"
                :field="'menu-item-link'"
                :value="this.$parent.model.link">
            </input-text>
            <input-number
                :label="this.$parent.$parent.labels.position"
                :field="'menu-item-position'"
                :value="this.$parent.model.position">
            </input-number>
            <input-select
                :label="this.$parent.$parent.labels.status"
                :field="'menu-item-status'"
                :options="this.statusOptions"
                :selected_option="this.selectedStatusOption"
                :value="this.$parent.model.status">
            </input-select>
            <input-textarea
                :label="this.$parent.$parent.labels.description"
                :field="'menu-item-description'"
                :value="this.$parent.model.description">
            </input-textarea>
            <button class="btn btn-success" id="editMenuItem" type="button" v-on:click="editMenuItem()">
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
    import InputNumber from "./InputNumber";
    import InputSelect from "./InputSelect";
    import InputTextarea from "./InputTextarea";

    export default {
        components: {InputText, InputTextarea, InputNumber, InputSelect},

        data() {
            return {
                menuItem: this.$parent.model,
                edited: false,
                statusOptions: this.setStatusOption(),
                selectedStatusOption: this.setSelectedOption(),
            }
        },

        methods: {
            editMenuItem() {
                axios.post('/admin/menu-items/' + this.$parent.model.id, this.getData())
                    .then(data => {
                        this.$parent.$parent.$data.orderedItems = data.data.menuItems;
                        this.edited = true;
                        this.$parent.editing = false;
                        flash('Translation edited.');
                    }).catch(function () {
                        flash('Something went wrong.');
                });
            },

            getData() {
                return {
                    title: $('#menu-item-title').val(),
                    link: $('#menu-item-link').val(),
                    position: $('#menu-item-position').val(),
                    status: $('#menu-item-status').val(),
                    description: $('#menu-item-description').val(),
                };
            },

            cancel() {
                this.edited = true;
                this.$parent.editing = false;
                flash('Editing menuItem canceled.');
            },

            setStatusOption () {
                if(this.$parent.model.status) {
                    return [{
                            name: this.$parent.$parent.labels['inactive'],
                            key: 1,
                            value: 0,
                        }];
                }

                return [{
                    name: this.$parent.$parent.labels['active'],
                    key: 0,
                    value: 1,
                }];
            },

            setSelectedOption() {
                if(!this.$parent.model.status) {
                    return {
                        name: this.$parent.$parent.labels['inactive'],
                        key: 1,
                        value: 0,
                    };
                }

                return {
                    name: this.$parent.$parent.labels['active'],
                    key: 0,
                    value: 1,
                };
            }
        }
    }
</script>

<style>
    .alert-flash {
        bottom: 43px;
    }
</style>