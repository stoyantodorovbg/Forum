<template>
    <div :class="'form-group ' + forIndex">
        <label v-if="forIndex" class="col-form-label">{{ label }}</label>
        <div>
            <input
                class="form-control translation"
                type="number"
                :id="field"
                :value="value">
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'label',
            'field',
            'value',
            'forIndex'
        ],
    }
</script>

<style>
    .for-index {
        width: 80px;
    }
</style>