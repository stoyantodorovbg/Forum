<template>
    <div :id="'reply-' + id" class="panel panel-default">
        <div class="panel-heading">
            <a :href="'/profiles/' + data.owner.name"
                v-text="data.owner.name">
            </a>
            said:
            <div v-if="editing">
                <div class="form-group">
                    <textarea class="form-control" v-model="body"></textarea>
                    <button class="btn xs btn-primary" @click="update">Update</button>
                    <button class="btn xs btn-link" @click="editing=false">Cancel</button>
                </div>
            </div>
            <div v-else v-text="body"></div>
        </div>
        <br>
        <div class="panel-footer level">
            <div v-if="signedIn">
                <favorite :reply="data"></favorite>
            </div>
            <div v-if="canUpdate">
                <button class="btn btn-xs mr-1" @click="editing = true">Edit</button>
                <button class="btn btn-danger btn-xs mr-1" @click="destroy">delete</button>
            </div>
        </div>
    </div>
</template>

<script>
    import Favorite from './Favorite.vue';

    export default {
        props: ['data', 'can-update'],

        components: { Favorite },

        data() {
            return {
                editing: false,
                id: this.data.id,
                body: this.data.body,
            };
        },

        computed: {
            signedIn() {
                return window.App.signedIn;
            },

            canUpdate() {
                return this.authorize(user => this.data.user_id == user.id)
            },
        },

        methods: {
            update() {
                axios.patch('/replies/' + this.data.id, {
                    body: this.body,
                });

                this.editing = false;

                flash('Updated.');
            },

            destroy() {
                axios.delete('/replies/' + this.data.id);

                this.$emit('deleted', this.data.id);

                $(this.$el).fadeOut(300);

                flash('Deleted.');
            },
        },

    }
</script>