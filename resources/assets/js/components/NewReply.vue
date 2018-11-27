<template>
    <div class="card">
        <div v-if="signedIn">
            <div class="form-group">
                <wysiwyg name="body"
                         v-model="body"
                         placeholder="Have you something to say?"
                         ref="trix"
                         :shouldClear="completed">
                </wysiwyg>

            </div>
            <div class="form-group">
                <button
                        class="btn btn-default"
                        type="submit"
                        @click="addReply">
                    Post
                </button>
            </div>
        </div>
        <div class="text-left" v-else>
            If you want to participate in this discussion, please, sign in:
            <a href="/login">Login</a>
        </div>
    </div>
</template>

<script>
    import 'at.js';
    import 'jquery.caret';

    export default {
        data() {
            return {
                'body': '',
                'completed': false,
            };
        },

        mounted() {
            $('#body').atwho({
                at: "@",
                delay: 750,
                callbacks: {
                    remoteFilter: function (query, callback) {
                        $.getJSON("/api/users", {name: query}, function (usernames) {
                            callback(usernames);
                        })
                    }
                }
            })
        },

        methods: {
            addReply() {
                axios.post(window.location.pathname + '/replies', {body: this.body})
                    .catch(error => {
                        flash(error.response.data, 'danger');
                    })
                    .then(({ data}) => {
                        this.body = '';
                        this.completed = true;

                        flash('Your reply has been posted');

                        this.$refs.trix.$refs.trix.value = '';

                        this.$emit('created', data);
                    });
            },
        }
    }
</script>