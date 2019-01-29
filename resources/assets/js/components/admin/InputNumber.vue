<template>
    <div :class="'form-group ' + forIndex">
        <label v-if="!forIndex" class="col-form-label">{{ label }}</label>
        <div>
            <input
                class="form-control"
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
        width: 55px;
        height: 20px;
        margin-bottom: 0;
    }

    .for-index div input {
        width: 55px;
        height: 20px;
        margin-top: 5px;
    }


</style>