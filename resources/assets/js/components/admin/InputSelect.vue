<template>
    <div class="form-group">
        <label class="col-form-label">{{ label }}</label>

            <select
                class="form-control"
                :id="field"
                :value="value">
                <option v-if="selected_option == null"
                        selected
                        value="">{{ default_value }}
                </option>
                <option v-else
                    :value="selected_option.value"
                    selected>
                    {{ selected_option.name }}
                </option>
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
            'selected_option'
        ],
    }
</script>