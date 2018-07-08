<template>
    <button type="submit" :class="classes" @click="toggle">
        <span class="glyphicon glyphicon-heart"></span>
        <span v-text="favoritesCount"></span>
        Like
    </button>
</template>

<script>
    export default {
        props: ['reply'],

        data() {
            return {
                'favoritesCount': this.reply.favoritesCount,
                'isFavorited': this.reply.isFavorited,
            }
        },

        computed: {
            classes() {
                return ['btn', this.isFavorited ? 'btn-primary mr-1' : 'btn-default mr-1'];
            },
        },

        methods: {
            toggle() {
                return this.isFavorited ? this.destroy() : this.create()
            },

            create() {
                axios.post(this.endpoint());

                this.isFavorited = true;

                this.favoritesCount++;
            },

            destroy () {
                axios.delete(this.endpoint());

                this.isFavorited = false;

                this.favoritesCount--;
            },

            endpoint() {
                return '/replies/' + this.reply.id + '/favorites';
            },
        }
    }
</script>