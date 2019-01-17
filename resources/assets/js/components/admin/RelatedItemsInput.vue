<template>
    <div>
        <div v-if="!relatedItems.length">{{ labels['role_without_permissions'] }}</div>
        <div class="element-row" v-for="item in relatedItems">
            <span class="info-edit-item">{{ item.title }}</span>
            <span class="delete-item"
                  @click="removeItem"
                  :data-id="item.id">&times;</span>
        </div>

        <div class="form-group">
            <label>{{ labels['add_item'] }}</label>
            <select class="form-control"
                    id="addRelatedItem"
                    @change="addItem">
                <option value="-1">{{ labels['choose_one'] }}</option>
                <option v-for="item in unusedRoles" :value="item.id">{{ item.title}}</option>
            </select>
        </div>

        <input type="hidden" id="items" :name="this.input_name" v-model="relatedItemsIds">
    </div>
</template>

<script>
    export default {
        props: [
            'all_items',
            'related_items',
            'url',
            'item_id',
            'input_name',
            'labels'
        ],

        data() {
            return {
                relatedItemsIds: this.getRelatedItemsIds(this.related_items),
                relatedItems: this.related_items,
                unusedRoles: this.getUnusedRoles(),
            }
        },

        methods: {
            getRelatedItemsIds(items) {
                let idsStr = '';
                for (let item of items ) {
                    idsStr += item.id + ',';
                }

                return idsStr;
            },

            getUnusedRoles() {
                let component = this;
                return this.all_items.filter(function (item) {
                    if (item.id != component.item_id) {
                        return item;
                    }
                });
            },

            addItem() {
                let selectedId = event.target.value;
                let item = this.getItemById(this.all_items, selectedId);
                this.relatedItems.push(item);
                this.refreshRelatedItemsIds();
                this.unusedRoles.splice( this.unusedRoles.indexOf(item), 1 );
                $('#addRelatedItem').val(-1);
            },

            removeItem() {
                let selectedId = event.target.getAttribute('data-id');
                let item = this.getItemById(this.all_items, selectedId);
                this.unusedRoles.push(item);
                this.relatedItems.splice( this.relatedItems.indexOf(item), 1 );
                this.refreshRelatedItemsIds();
            },

            getItemById(array, id) {
                return array.filter(function (item) {
                    return item.id == id;
                })[0];
            },

            refreshRelatedItemsIds() {
                this.relatedItemsIds = this.getRelatedItemsIds(this.relatedItems);
            }
        }
    }
</script>

<style>
    .delete-item {
        padding: 0 7px 0 7px;
    }

    .delete-item:hover {
        border: 2px solid red;
        cursor: pointer;
    }

    .element-row {
        margin-bottom: 6px;
    }
</style>