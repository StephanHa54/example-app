<template>
    <div class="relative">
        <div class="relative z-50" aria-haspopup="true" aria-controls="dropdown-menu" @click.prevent="isOpen = !isOpen">
            <button v-if="isOpen">
                <slot name="activated"></slot>
            </button>
            <button v-else>
                <slot name="deactivated"></slot>
            </button>
        </div>
        <!-- Background that covers the whole screen -->
        <button v-if="isOpen" @click.prevent="isOpen = false" tabindex="-1"
            class="fixed inset-0 h-full w-full bg-gray-500 opacity-50 cursor-default">
        </button>
        <div v-show="isOpen" id="open-nav-menu" class="absolute">
            <slot name="main"></slot>

        </div>
    </div>
</template>

<script>
export default {
    data() {
        return { isOpen: false }
    },
    created(){
        /**
         * Event listener to watch if escape key is used while menu is open.
         */
        const handleEscape = (e) => {
            if(e.key === 'Esc' || e.key === 'Escape'){
                this.isOpen = false
                document.removeEventListener('keydown', handleEscape)
            }
        }
        document.addEventListener('keydown', handleEscape)
    }
}
</script>