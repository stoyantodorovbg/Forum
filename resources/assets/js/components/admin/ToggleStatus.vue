<template>
    <td scope="row">
        <label class="switch">
            <input type="checkbox" @change="toggleStatus" :checked="this.model.status">
            <span class="slider round"></span>
        </label>
    </td>
</template>

<script>
    export default {
        props: [
            'model',
            'model_type',
        ],

        methods: {
            toggleStatus() {
                axios.post('/admin/model-status', {
                    model_type: this.model_type,
                    model_id: this.model.id,
                }).then(function (data) {
                    let status = data.data ? 'Active' : 'Inactive';
                    flash('Status changed to ' + status + '.');
                }).catch(function () {
                    flash('Something went wrong.');
                });
            },
        }
    }
</script>

<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 30px;
        height: 17px;
        margin-top: 4px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 11px;
        width: 11px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #28a745;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #28a745;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(13px);
        -ms-transform: translateX(13px);
        transform: translateX(13px);
    }

    .slider.round {
        border-radius: 17px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>