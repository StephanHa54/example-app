<template>
    <div>
        <div class="relative">
            <button @click.prevent="openModal">
                <slot name="modal-button"></slot>
            </button>
        </div>
        <!-- Background that covers the whole screen -->
        <button v-if="open === name+1 && open_outside" @click.prevent="closeModal" tabindex="-1"
            class="fixed inset-0 h-full w-full cursor-default z-20"
            :class="modal_bg_color">
        </button>
        <button v-else-if="open === name+1" tabindex="-1"
            class="fixed inset-0 h-full w-full cursor-default z-20"
            :class="modal_bg_color">
        </button>
        <div v-show="open === name+1" class="center-of-window z-30 flex flex-col justify-between bg-white rounded-lg shadow-lg p-2 max-h-[90%]"
            :class="modal_width">
            <div class="flex justify-between items-center">
                <div></div>
                <slot name="header"></slot>
                <button @click.prevent="closeModal" class="w-8 h-8 rounded-full flex justify-center items-center text-accent hover:bg-gray-300 hover:text-primary">
                    X
                </button>
            </div>
            <div class="overflow-y-scroll hide-scrollbar">
                <slot name="body"></slot>
            </div>
            <slot name="footer"></slot>
        </div>
    </div>
</template>
    
<script>
    export default { 
        data() {
            return {
                open: '',
                modal_width: '',
                open_outside: '',
                modal_bg_color: '',
            }
        },
        props: [
            'name',
            'width',
            'background',
            'click_outside',
        ],
        mounted () {
            this.setModalName()
            this.setModalWidth()
            this.setOpenOutside()
            this.setModalBackground()
        },
        created(){
            /**
             * Event listener to watch if escape key is used while menu is open.
             */
            const handleEscape = (e) => {
                if((e.key === 'Esc' || e.key === 'Escape')&& this.click_outside){
                    this.open = this.name+0
                    document.removeEventListener('keydown', handleEscape)
                }
            }
            document.addEventListener('keydown', handleEscape)
        },
        methods: {
            setModalName(){
                return this.open = this.name+0
            },
            setModalWidth(){
                if(this.width === 'large'){
                    return this.modal_width = 'w-5/6 md:w-4/5 lg:w-2/3'
                }else if(this.width === 'medium'){
                    return this.modal_width = 'w-4/5 md:w-2/3 lg:w-1/2'
                }else if(this.width === 'small'){
                    return this.modal_width = 'w-3/4 md:w-1/2 lg:w-1/3'
                }else{
                    return this.modal_width = 'w-4/5 md:w-2/3 lg:w-1/2'
                }
            },
            setOpenOutside(){
                if(this.click_outside===false){
                    return this.open_outside = false
                }else{
                    return this.open_outside = true
                }
            },
            setModalBackground(){
                if(this.background === 'clear'){
                    return this.modal_bg_color = 'clear-background'
                }else if(this.background === 'light'){
                    return this.modal_bg_color = 'light-background'
                }else if(this.background === 'dark'){
                    return this.modal_bg_color = 'dark-background'
                }else{
                    return this.modal_bg_color = 'clear-background'
                }
            },
            openModal(){
                return this.open = this.name+1
            },
            closeModal(){
                return this.open = this.name+0
            }
        }
    }
</script>