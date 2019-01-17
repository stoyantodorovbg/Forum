<template>
    <button :class="classes" @click="subscribe">Subscribe</button>
</template>

<script>
    export default {
        props: [
            'active'
        ],

        computed: {
            classes() {
                return ['btn', this.active ? 'btn-primary' : 'btn-default'];
            },
        },

        methods: {
            subscribe() {
                let requestType = this.active ? 'delete' : 'post';

                axios[requestType](window.location.pathname + '/subscriptions');

                this.active = ! this.active;

                flash('Subscribed');
            },
        },
    }
</script>