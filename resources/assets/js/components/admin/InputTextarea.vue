<template>
    <div class="form-group">
        <label class="col-form-label">{{ label }}</label>
        <textarea
            class="form-control"
            :id="field" rows="10">{{ value}}</textarea>
    </div>
</template>

<script>
    export default {
        props: [
            'label',
            'field',
            'value',
        ],
    }
</script>