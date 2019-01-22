<template>
    <div class="form-group">
        <label class="admin-search-label">{{ labels['search_label'] }}</label>
        <select class="form-control" :id="name">
            <option value="">{{ labels['all'] }}</option>
            <option v-for="item in items" :value="item.title">{{ item[prop_name] }}</option>
        </select>
    </div>
</template>

<script>
    export default {
        props: [
            'name',
            'prop_name',
            'items',
            'labels'
        ]
    }
</script>