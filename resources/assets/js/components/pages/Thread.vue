<script>
    import Replies from '../Replies.vue';
    import SubscribeButton from '../SubscribeButton.vue';

    export default {
        props: ['dataRepliesCount', 'dataLocked'],

        components: { Replies, SubscribeButton },

        data() {
            return {
                repliesCount: this.dataRepliesCount,
                locked: this.dataLocked,
            }
        }
    }
</script>