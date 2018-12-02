<template>
    <tr>
        <th scope="row">
            <button class="btn btn-success btn-sm">
                <i class="glyphicon glyphicon-pencil">&#x270f;</i>
            </button>
        </th>

        <index-property v-for="property in properties" :key="property.id" :model="model" :property="property"></index-property>
        <td>
            <button class="btn btn-danger btn-sm">
                <span aria-hidden="true">&times;</span>
            </button>
        </td>
    </tr>
</template>

<script>
    import IndexProperty from "./IndexProperty";

    export default {
        components: {IndexProperty},
        props: ['model', 'properties'],
    }
</script>