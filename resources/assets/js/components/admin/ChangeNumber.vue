<template>
    <div :class="'form-group ' + forIndex">
        <label v-if="!forIndex" class="col-form-label">{{ label }}</label>
        <div>
            <input
                class="form-control admin-input-number"
                type="number"
                :id="field"
                :value="value"
                @change="changePosition">
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'label',
            'field',
            'value',
            'forIndex',
            'model_type',
            'model',
            'model_property',
        ],

        methods: {
            changePosition() {
                let request = {
                    model_type: this.model_type,
                    model_id: this.model.id,
                    model_property: this.model_property,
                };
                let component = this;
                request[this.model_property] = $('#menuItem-' + this.model.id).val()
                axios.post('/admin/model-position', request)
                    .then(function (data) {
                        let position = data.data;
                        component.updateParentPosition(position);
                    flash('Position changed to ' + data.data + '.');
                }).catch(function () {
                    flash('Something went wrong.');
                });
            },

            updateParentPosition(position) {
                this.$parent.model.position = position;
                this.$parent.position = position;
            }
        }
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