<template>
    <div class="form-group">
        <label class="col-form-label">{{ label }}</label>
        <textarea class="form-control" :id="'translation-' + field" rows="10"></textarea>
    </div>
</template>

<script>
    export default {
        props: ['label', 'field']
    }
</script>