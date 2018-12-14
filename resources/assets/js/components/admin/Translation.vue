<template>
    <tr>
        <td>{{ translation.language.title }} </td>
        <td>{{ translation.content }}</td>
    </tr>
</template>

<script>
    export default {
        props: ['translation'],
    }
</script>