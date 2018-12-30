<template>
    <div class="form-group">
        <label class="col-form-label">{{ label }}</label>
        <div>
            <input class="form-control translation" :id="'translation-' + field">
        </div>
    </div>
</template>

<script>
    export default {
        props: ['label', 'field']
    }
</script>