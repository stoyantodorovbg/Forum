<script>
    import Replies from '../Replies.vue';
    import SubscribeButton from '../SubscribeButton.vue';

    export default {
        props: ['thread', 'language_id', 'translation'],

        components: { Replies, SubscribeButton },

        data() {
            return {
                repliesCount: this.thread.replies_count,
                locked: this.thread.locked,
                editing: false,
                form: {
                    title: this.thread.title,
                    body: this.thread.body,
                    channel_id: this.thread.channel_id,
                },
            }
        },

        created() {
            axios.get('/api/thread-translation?thread_id=' + this.thread.id + '&language_id=' + this.language_id)
                .then((response) => {
                    this.translation =  response.data;
                    if(this.translation) {
                        this.form.title = this.translation.title;
                        this.form.body = this.translation.body;
                    }
                });

        },

        methods: {
            toggleLock() {
                axios[this.locked ? 'delete' : 'post']('/locked-threads/' + this.thread.slug);

                this.locked = ! this.locked;
            },

            cancel() {
                if(!this.translation) {
                    this.form.title = this.thread.title;
                    this.form.body = this.thread.body;
                } else {
                    this.form.title = this.translation.title;
                    this.form.body = this.translation.body;
                }

                this.editing = false;
            },

            update() {
                let url = '/threads/' + this.thread.slug;
                let flash = 'Your thread has been updated.';

                if(!this.translation) {
                    this.updateRequest(url, this.form, flash);
                } else {
                    let data = { channel_id: this.form.channel_id };
                    this.updateRequest(url, data, false);

                    url = 'api/thread-translation/' + this.translation.id;
                    data = {
                        title: this.form.title,
                        body: this.form.body,
                    };
                    this.updateRequest(url, data, false);
                }
            },

            updateRequest(url, data, flash) {
                axios.patch(url, data).then(() => {
                    this.editing = false;
                    if (flash) {
                        flash(flash);
                    }
                });
            },
        }
    }
</script>