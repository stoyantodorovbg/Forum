<template>
    <div class="form-group">
        <label class="col-form-label">{{ label }}</label>
        <textarea class="form-control" rows="10"></textarea>
    </div>
</template>

<script>
    export default {
        props: ['label']
    }
</script>