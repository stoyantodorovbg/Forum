<template>
    <div class="container">
        <add-translation
            v-if="dataTranslations.length < languages.length - 1"
            :languages="languages"
            :label="label"
            :labels="labels"></add-translation>
        <table class="table table-sm">
            <thead>
                <tr>
                    <th scope="col">{{ labels['edit'] }}</th>
                    <th scope="col">{{ labels['language'] }}</th>
                    <th scope="col">{{ labels['body'] }}</th>
                    <th scope="col">{{ labels['delete'] }}</th>
                </tr>
            </thead>
                <tbody>
                    <translation
                        v-for="translation in dataTranslations"
                        :key="translation.id"
                        :translation="translation">
                    </translation>
                </tbody>
        </table>
    </div>
</template>

<script>
    import Translation from "./Translation";
    import AddTranslation from "./AddTranslation";

    export default {
        components: {Translation, AddTranslation},

        props: ['translations', 'labels', 'languages', 'label',],

        data() {
            return {
                dataTranslations: this.$props.translations,
            }
        }
    }

</script>