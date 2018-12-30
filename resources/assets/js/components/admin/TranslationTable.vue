<template>
    <div class="container">
        <add-translation
            v-if="dataTranslations.length < languages.length - 1"
            :item="item"></add-translation>
        <table class="table table-sm">
            <thead>
                <tr>
                    <th scope="col">{{ labels['edit'] }}</th>
                    <th scope="col">{{ labels['language'] }}</th>
                    <th scope="col" v-for="field in this.text_input_labels">{{ field[0] }}</th>
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

        props: [
            'translations',
            'labels',
            'text_input_labels',
            'textarea_input_labels',
            'languages',
            'item',
            'item_name',
            'text_inputs',
            'textarea_inputs',
            'url',
        ],

        data() {
            return {
                dataTranslations: this.$props.translations,
            }
        }
    }

</script>