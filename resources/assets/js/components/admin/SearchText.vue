<template>
    <div class="form-group">
        <label class="admin-search-label">{{ labels['search_label'] }}</label>
        <input class="form-control admin-search-text" :id="name" type="text">
    </div>
</template>

<script>
    export default {
        props: [
            'name',
            'labels'
        ]
    }
</script>