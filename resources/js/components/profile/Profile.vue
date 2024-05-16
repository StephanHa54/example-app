<template>
    <div class="p-4 sm:p-8 bg-white shadow rounded-lg">
        <div>
            <header>
                <h2 class="text-lg font-medium text-gray-600">
                    Profile Information
                </h2>
            </header>
            <!-- Avatar Component -->
            <avatar :user="user"></avatar>
            <span class="text-gray-400 text-lg py-1">{{ user.email }}</span>
            <form class="flex-col justify-center items-center mb-6" v-if="!loading">
                <div class="my-2">
                    <label class="input-label" for="first_name">First Name</label>
                    <input 
                        v-model="user.first_name"
                        id="first_name" 
                        name="first_name" 
                        type="text"
                        required autocomplete="first_name">
                    <span class="input-error mt-2" v-if="errors.first_name" v-text="errors.first_name[0]"></span>
                </div>
                <div class="my-2">
                    <label class="input-label" for="first_name">Last Name</label>
                    <input 
                        v-model="user.last_name"
                        id="last_name" 
                        name="last_name" 
                        type="text"
                        required autocomplete="last_name">
                    <span class="input-error mt-2" v-if="errors.last_name" v-text="errors.last_name[0]"></span>
                </div>
                <div class="flex py-4">
                    <button class="btn-primary-accent" href="#" :disabled="submitting" @click.prevent="updateUser">
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
                loading: false,
                submitting: false,
                user: {},
                errors: {}
            }
        },
        mounted () {
            this.getUser()
        },
        methods: {
            /**
             * Get the user information 
             */
            getUser () {
                this.loading = true
                axios.get(`/api/auth/user`)
                .then(response => {
                    this.user = response.data
                    this.loading = false
                })
            },
            /**
             * Update the user information
             */
            updateUser () {
                if (!this.submitting) {
                    this.submitting = true
                    axios.put(`/api/profile/updateUser`, this.user)
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