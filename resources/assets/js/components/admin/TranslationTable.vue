<template>
    <div>
        <add-translation
            v-if="translations.length < languages.length"
            :languages="languages"
            :label="label"
            :labels="labels"></add-translation>
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
    </div>
</template>

<script>
    import Translation from "./Translation";
    import AddTranslation from "./AddTranslation";

    export default {
        components: {Translation, AddTranslation},

        props: ['translations', 'labels', 'languages', 'label',],

        mounted() {
            $('#saveTranslation').click(function () {

                axios.get('/admin/translations/label-translations', {
                    params: {
                        label_id: this.label.id,
                    }
                }).then(function(response) {//console.log(response.data)
                    this.props.translations = response.data;
                })
            })
        },
    }

</script>