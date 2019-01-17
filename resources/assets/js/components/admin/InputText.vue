<template>
    <div class="form-group">
        <label class="col-form-label">{{ label }}</label>
        <div>
            <input
                class="form-control translation"
                :id="'translation-' + field"
                :value="value"></div>
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