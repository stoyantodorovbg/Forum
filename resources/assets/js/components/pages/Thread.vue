<script>
    import Replies from '../Replies.vue';
    import SubscribeButton from '../SubscribeButton.vue';

    export default {
        props: ['thread', 'language_id'],

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
                translation: "",
            }
        },

        created() {
            axios.get('/api/thread-translation?thread_id=' + this.thread.id + '&language_id=' + this.language_id)
                .then((response) => {
                    this.translation =  response.data;
                });

        },

        methods: {
            toggleLock() {
                axios[this.locked ? 'delete' : 'post']('/locked-threads/' + this.thread.slug);

                this.locked = ! this.locked;
            },

            cancel() {
                this.form.title = this.thread.title;
                this.form.body = this.thread.body;
                this.editing = false;
            },

            update() {
                axios.patch('/threads/' + this.thread.slug, {
                    title: this.form.title,
                    body: this.form.body,
                    channel_id: this.form.channel_id
                }).then(() => {
                    this.editing = false;
                    flash('Your thread has been updated.')
                });
            },
        }
    }
</script>