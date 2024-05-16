<template>
    <div>
        <div class="flex items-center">
            <!-- Current Avartar image -->
            <img class="w-24 h-24 rounded-full" :src="user.avatar_url">
            <div class="flex flex-col m-2 flex-grow">
                <div class="flex flex-col justify-start mb-2 w-36">
                    <!-- Upload custom avatar -->
                    <input id="file-input" type="file" @change="uploadFile($event)" hidden/>
                    <label for="file-input" class="btn-primary-accent">Choose File</label>
                    <!-- Reset to default Avatar -->
                    <button class="btn-gray-accent mt-2" @click="removeAvatarAuthUser" :disabled="submiting">
                        Reset Avatar
                    </button>
                </div>
                <!-- Display errors -->
                <small class="text-grey text-xs font-hairline">The maximum file size allowed is 10MB</small>
                <small class="input-error" v-if="errors.file" v-text="errors.file[0]"></small>
            </div>
        </div>
        <!-- Upload progress -->
        <div v-if="uploadPercentage > 0 && uploadPercentage < 100" class="flex items-center">
            <progress max="100" class="h-2" :value.prop="uploadPercentage"></progress>
        </div>
        <div v-else class="h-2"></div>
    </div>
</template>
<script>
    export default {
        data () {
            return {
                submiting: false,
                file: '',
                uploadPercentage: 0,
                errors: {},
            }
        },
        props: [
            'user'
            ],
        methods: {
            /**
             * Update user avatar with custom image
             */
                uploadFile (event) {
                this.submiting = true
                this.file = event.target.files[0];
                let formData = new FormData();
                formData.append('file', this.file);
                axios.post(`/api/profile/uploadAvatar`, formData, 
                { 
                    headers: { 'Content-Type': 'multipart/form-data' },
                    onUploadProgress: function(progressEvent){
                        this.uploadPercentage = parseInt( Math.round((progressEvent.loaded / progressEvent.total)*100));
                    }.bind(this)
                })
                .then(response => {
                    this.submiting = false
                    this.errors = {}
                    this.user.avatar_url = response.data.avatar_url
                })
                .catch(error => {
                    this.submiting = false
                    this.errors = error.response.data.errors
                })
            },
            /**
             * reset to default avatar image
             */
            removeAvatarAuthUser () {
                this.submiting = true
                axios.delete(`/api/profile/removeAvatar`)
                .then(response => {
                    this.errors = {}
                    this.submiting = false
                    this.user.avatar_url = response.data.avatar_url
                })
                .catch(error => {
                    this.errors = error.response.data.errors
                    this.submiting = false
                })
            }
        }
    }
</script>