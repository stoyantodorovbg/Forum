<template>
    <div>
        <button v-if="!addingMenuItem" class="btn btn-success" v-on:click="displayInputs()" type="button">
            {{ this.$parent.labels['add_a_menu_item'] }}
        </button>
        <div v-if="this.addingMenuItem">
            <!--<div class="form-group">-->
                <!--<label class="col-form-label">{{ this.$parent.labels['language'] }}</label>-->
                <!--<select class="form-control menuItem-language-id">-->
                    <!--<option-->
                        <!--v-for="language in this.$parent.languages"-->
                        <!--v-if="language.id !== item.default_language_id &&-->
                        <!--!labelLanguages.includes(language.title)"-->
                        <!--v-model="selected"-->
                        <!--:value="language.id">-->
                        <!--{{ language.title }}-->
                    <!--</option>-->
                <!--</select>-->
            <!--</div>-->
            <input-text
                :label="this.$parent.labels.title"
                :field="'menu-item-title'">
            </input-text>
            <input-text
                :label="this.$parent.labels.link"
                :field="'menu-item-link'">
            </input-text>
            <input-number
                :label="this.$parent.labels.position"
                :field="'menu-item-position'">
            </input-number>
            <input-select
                :label="this.$parent.labels.status"
                :field="'menu-item-status'"
                :options="this.statusOptions"
                :default_value="this.$parent.labels.choose_one">
                <!--:selected_value="this.selectedValue">-->
            </input-select>
            <input-textarea
                :label="this.$parent.labels.description"
                :field="'menu-item-description'">
            </input-textarea>
            <button class="btn btn-success" id="saveMenuItem" type="button" v-on:click="addMenuItem(menuId)">
                {{ this.$parent.labels['save_menu_item'] }}
            </button>
            <button class="btn btn-info" type="button" @click="cancel">
                {{ this.$parent.labels['cancel'] }}
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
                addingMenuItem: false,
                statusOptions: [
                    {
                        name: this.$parent.labels['inactive'],
                        key: 1,
                        value: 0,
                    },
                    {
                        name: this.$parent.labels['active'],
                        key: 0,
                        value: 1,
                    },
                ],
                // selectedValue: {
                //     name: this.$parent.labels['inactive'],
                //     value: 0,
                // },
                menuId: this.$parent.menu.id,
            }
        },

        methods: {
            displayInputs() {
                this.addingMenuItem = true;
            },

            addMenuItem(id) {
                let data = this.getData();
                data['menu_id'] = id;
                axios.post('/admin/menu-items/store', data).then(data => {
                    this.$parent.$data.dataMenuItems = data.data.menuItems;
                    this.$parent.$data.orderedItems = data.data.menuItems;
                    flash('Menu item added.');
                }).catch(function () {
                    flash('Something went wrong.');
                });
                this.addingMenuItem = false;
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
                this.addingMenuItem = false;
                flash('Adding menu item canceled.');
            },
        }
    }
</script>

<style>
    .alert-flash {
        bottom: 43px;
    }
</style>