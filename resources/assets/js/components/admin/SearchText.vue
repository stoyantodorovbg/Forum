<template>
    <div class="form-group">
        <label class="admin-search-label">{{ labels['search_label'] }}</label>
        <input class="form-control" :id="name" type="text">
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