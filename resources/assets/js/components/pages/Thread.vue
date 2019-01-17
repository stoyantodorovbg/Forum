<script>
    import Replies from '../Replies.vue';
    import SubscribeButton from '../SubscribeButton.vue';

    export default {
        props: [
            'thread',
            'language_id'
        ],

        components: { Replies, SubscribeButton },

        data() {
            return {
                repliesCount: this.thread.replies_count,
                locked: this.thread.locked,
                editing: false,
                translation: false,
                addingTranslation: false,
                form: {
                    title: this.thread.title,
                    body: this.thread.body,
                    channel_id: this.thread.channel_id,
                },
            }
        },

        watch: {
            addingTranslation: {
                immediate: true,
                handler (val, oldVal) {
                    if (val) {
                        this.setEmptyProperties();
                    } else {
                        if(this.translation) {
                            this.setTranslationProperties();
                        } else {
                            this.setThreadProperties();
                        }
                    }
                }
            }
        },

        created() {
            axios.get('/api/thread-translation?thread_id=' + this.thread.id + '&language_id=' + this.language_id)
                .then((response) => {
                    this.translation =  response.data;
                    if(this.translation) {
                        this.setTranslationProperties();
                    }
                });

        },

        methods: {
            toggleLock() {
                axios[this.locked ? 'delete' : 'post']('/locked-threads/' + this.thread.slug);

                this.locked = !this.locked;
            },

            cancel() {
                if(!this.translation) {
                    this.setThreadProperties();
                } else {
                    this.setTranslationProperties();
                }

                this.editing = false;
            },

            storeChanges() {
                let url = '/threads/' + this.thread.slug;
                let flash = 'Your thread has been updated.';

                if(!this.translation && !this.addingTranslation) {
                    this.updateRequest(url, this.form, flash, false);
                } else if (this.addingTranslation) {
                    this.storeTranslationRequest()
                } else {
                    let data = { channel_id: this.form.channel_id };
                    this.updateRequest(url, data, false, false);

                    url = 'api/thread-translation/' + this.translation.id;
                    data = {
                        title: this.form.title,
                        body: this.form.body,
                    };
                    this.updateRequest(url, data, false, true);
                }
            },

            storeTranslationRequest() {
                axios.post('api/thread-translation', {
                    language_id: this.language_id,
                    thread_id: this.thread.id,
                    title: this.form.title,
                    body: this.form.body,
                }).then((response) => {
                    this.editing = false;
                    this.addingTranslation = false;
                    this.translation = response.data;
                    flash('The translation is added.');
                });
            },

            deleteTranslation() {
                axios.delete('api/thread-translation/' + this.translation.id)
                    .then(() => {
                            this.translation = '';
                            this.setThreadProperties();
                            flash('The translation is deleted.');
                    });
            },

            updateRequest(url, data, flash, updateTranslation) {
                axios.patch(url, data).then((response) => {
                    this.editing = false;
                    if(updateTranslation) {
                        this.translation = response.data;
                    }
                    if (flash) {
                        flash(flash);
                    }
                });
            },

            setThreadProperties() {
                this.form.title = this.thread.title;
                this.form.body = this.thread.body;
            },

            setTranslationProperties() {
                this.form.title = this.translation.title;
                this.form.body = this.translation.body;
            },

            setEmptyProperties() {
                this.form.title = '';
                this.form.body = '';
            }
        }
    }
</script>