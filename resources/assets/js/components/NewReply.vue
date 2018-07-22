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
    export default {
        props: ['endpoint'],

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

        methods: {
            addReply() {
                axios.post(this.endpoint, {body: this.body})
                    .then(({ data}) => {
                        this.body = '';

                        flash('Your reply has been posted');

                        this.$emit('created', data);
                    });
            },
        }
    }
</script>