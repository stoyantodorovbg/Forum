<template>
    <div :id="'reply-' + id" class="panel panel-default mr-3">
        <div class="card-header" :class="isBest ? 'panel-green' : ''">
            <div class="level">
                <a :href="'/profiles/' + data.owner.name"
                    v-text="data.owner.name">
                </a>
                said: <span v-text="ago"></span>
            </div>
        </div>
        <div class="card-body">
            <div v-if="editing">
                <form @submit="update">
                    <div class="form-group">
                        <textarea class="form-control" v-model="body" required></textarea>
                    </div>
                    <button class="btn xs btn-primary">Update</button>
                    <button class="btn xs btn-link" @click="editing=false" type="button">Cancel</button>
                </form>
            </div>
            <div  v-else v-html="body"></div>
        </div>
        <div class="panel-footer level">
            <div v-if="signedIn">
                <favorite :reply="data"></favorite>
            </div>
            <div v-if="authorize('updateReply', reply)">
                <button class="btn btn-xs mr-1" @click="editing = true">Edit</button>
                <button class="btn btn-danger btn-xs mr-1" @click="destroy">Delete</button>
            </div>
            <button class="btn btn-success btn-xs mr-1" @click="markBestReply" v-show="!isBest">Best reply</button>
        </div>
    </div>
</template>

<script>
    import Favorite from './Favorite.vue';
    import moment from 'moment';

    export default {
        props: ['data', 'can-update'],

        components: { Favorite },

        data() {
            return {
                editing: false,
                id: this.data.id,
                body: this.data.body,
                isBest: this.data.isBest,
                reply: this.data,
            };
        },

        computed: {
            ago(){
                return moment(this.data.created_at).fromNow();
            },
        },

        created() {
            window.events.$on('best-reply-selected', id => {
                this.isBest = (id === this.data.id);
            });
        },

        methods: {
            update() {
                axios.patch('/replies/' + this.data.id, {
                    body: this.body,
                }).catch(error => {
                    flash(error.response.data, 'danger');
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

            markBestReply() {
                axios.post('/replies/' + this.data.id + '/best');

                window.events.$emit('best-reply-selected', this.data.id);
            },
        },

    }
</script>