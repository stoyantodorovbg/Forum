<template>
    <div class="form-group">
        <label class="admin-search-label">{{ labels['search_label'] }}</label>
        <select class="form-control" :id="name">
            <option value="1">{{ labels['first_option'] }}</option>
            <option value="0">{{ labels['second_option'] }}</option>
        </select>
    </div>
</template>

<script>
    export default {
        props: [
            'name',
            'labels',
        ]
    }
</script>