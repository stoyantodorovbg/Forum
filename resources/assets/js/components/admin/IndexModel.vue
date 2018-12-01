<template>
    <tr>
        <th scope="row">
            <button class="btn btn-success btn-sm">
                <i class="glyphicon glyphicon-pencil">&#x270f;</i>
            </button>
        </th>
        <td v-text="model.title"></td>
        <td v-text="model.owner.name"></td>
        <td v-text="model.created_at"></td>
        <td>
            <button class="btn btn-danger btn-sm">
                <span aria-hidden="true">&times;</span>
            </button>
        </td>
    </tr>
</template>

<script>
    export default {
        props: ['model'],



        // computed: {
        //     model() {
        //         return this.model;
        //     }
        // },
    }
</script>