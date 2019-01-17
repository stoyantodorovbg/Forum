<template>
    <div class="form-group">
        <label class="admin-search-label">From</label>
        <input class="form-control admin-search-date" :id="this.from" type="date">
        <label class="admin-search-label">To</label>
        <input class="form-control admin-search-date" :id="this.to" type="date">
    </div>
</template>

<script>
    export default {
        props: [
            'name'
        ],

        data() {
            return {
                from: this.name + '_from',
                to: this.name + '_to',
            }
        }
    }
</script>

<style>
    .admin-search-date {
        width: 91% !important;
    }
</style>