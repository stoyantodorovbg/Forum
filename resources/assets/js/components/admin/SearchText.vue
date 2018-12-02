<template>
    <input class="form-control" :id="name" type="text">
</template>

<script>
    export default {
        props: ['name']
    }
</script>