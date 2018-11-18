<template>
    <div>
        <div class="level">
            <img :src="avatar"
                 :alt="user.name"
                 width="150" height="150"
                 class="mr-1">
            <h2 v-text="user.name"></h2>
        </div>
        <form v-if="canUpdate" method="POST"
              enctype="multipart/form-data">
            <image-upload name="avatar_path" class="mr-1" @loaded="onLoad"></image-upload>
        </form>
    </div>
</template>

<script>
    import ImageUpload from './ImageUpload.vue'
    export default {
        props: ['user'],

        components: { ImageUpload },

        data() {
            return {
                avatar: '/storage/' + this.user.avatar_path,
            }
        },

        computed: {
            canUpdate() {
                return this.authorize(user => user.id === this.user.id);
            }
        },

        methods: {
            onLoad(data) {
                this.avatar = data.src;

                this.persist(data.file);
            },

            persist(avatar) {
                let data = new FormData();

                data.append('avatar_path', avatar);

                axios.post(`/api/users/${this.user.name}/avatar`, data)
                    .then(() => flash('Avatar uploaded.'));
            }
        },
    }
</script>