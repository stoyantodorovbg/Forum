<template>
    <div class="form-group">
        <label class="admin-search-label">Type a  text</label>
        <input class="form-control" :id="name" type="text">
    </div>
</template>

<script>
    export default {
        props: ['name']
    }
</script>