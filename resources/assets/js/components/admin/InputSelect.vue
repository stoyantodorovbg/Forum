<template>
    <div class="form-group">
        <label class="col-form-label">{{ label }}</label>

            <select
                class="form-control"
                :id="field"
                :value="value"
                v-model="selected">
                <option disabled value="">{{ default_value }}</option>
                <!--<option v-if="default_value != null" :selectded value="">{{ default_value }}</option>-->
                <option v-for="option in options"
                    :key="option.key"
                    :value="option.value">
                    {{ option.name }}
                </option>
            </select>

    </div>
</template>

<script>
    export default {
        props: [
            'label',
            'field',
            'value',
            'default_value',
            'options',
        ],
    }
</script>