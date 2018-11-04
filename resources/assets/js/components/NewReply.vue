<template>
    <!--@if (auth()->check())-->
    <div class="card">
        <div v-if="signedIn">
            <div class="form-group">
                 <textarea
                         class="form-control"
                         name="body"
                         id="body"
                         placeholder="Have you something to say?"
                         rows="5"
                         required
                         v-model="body">
                 </textarea>
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
            };
        },

        computed: {
            signedIn() {
                return window.App.signedIn;
            },
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

                        flash('Your reply has been posted');

                        this.$emit('created', data);
                    });
            },
        }
    }
</script>