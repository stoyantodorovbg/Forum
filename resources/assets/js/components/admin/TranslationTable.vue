<template>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">{{ labels['language'] }}</th>
            <th scope="col">{{ labels['body'] }}</th>
        </tr>
        </thead>
        <tbody>
            <translation
                v-for="translation in translations"
                :key="translation.id"
                :translation="translation">
            </translation>
        </tbody>
    </table>
</template>

<script>
    import Translation from "./Translation";

    export default {
        components: {Translation},

        props: ['translations', 'labels'],

        created() {
            console.log(this.translations[0])
        }
    }

</script>