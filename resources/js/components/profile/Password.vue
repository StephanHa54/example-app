<template>
    <div class="p-4 sm:p-8 bg-white shadow rounded-lg">
        <div class="max-w-xl">
            <header>
                <h2 class="text-lg font-medium text-gray-900">
                    Update Password
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Ensure your account is using a long, random password to stay secure.
                </p>
            </header>
            <form class="flex-col justify-center items-center my-6">
                <div class="my-2">
                    <label class="input-label" for="current_password">Current Password</label>
                    <input 
                        v-model="password.current_password"
                        id="current_password" 
                        name="current_password" 
                        type="password"
                        required autocomplete="current_password">
                    <span class="input-error mt-2" v-if="errors.current_password" v-text="errors.current_password[0]"></span>
                </div>
                <div class="my-2">
                    <label class="input-label" for="password">New Password</label>
                    <input 
                        v-model="password.password"
                        id="password" 
                        name="password" 
                        type="password"
                        required autocomplete="password">
                    <span class="input-error mt-2" v-if="errors.password" v-text="errors.password[0]"></span>
                </div>
                <div class="my-2">
                    <label class="input-label" for="password_confirmation">Confirm Password</label>
                    <input 
                        v-model="password.password_confirmation"
                        id="password_confirmation" 
                        name="password_confirmation" 
                        type="password"
                        required autocomplete="password_confirmation">
                    <span class="input-error mt-2" v-if="errors.password_confirmation" v-text="errors.password_confirmation[0]"></span>
                </div>
                <div class="flex py-4">
                    <button class="btn-primary-accent" href="#" :disabled="submitting" @click.prevent="updatePassword">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
    
<script>
    export default { 
        data() {
            return {
                submitting: false,
                password: {},
                errors: {}
            }
        },
        methods: {
            /**
             * Update password
             */
            updatePassword () {
                if (!this.submitting) {
                    this.submitting = true
                    axios.put(`/api/profile/updatePassword`, this.password)
                    .then(response => {
                        this.errors = {}
                        this.submitting = false
                        // this.$toasted.global.show('Profile updated!');
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors
                        this.submitting = false
                    })
                }
            }
        }        
    }
</script>