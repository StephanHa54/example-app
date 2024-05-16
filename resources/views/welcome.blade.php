<x-guest-layout>
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <a href="/" class="flex flex-col justify-center items-center">
            <img class="w-20 h-20" src='/images/example-app_teal_blue.png' alt="Example-App">
        </a>
        <div class="flex justify-center items-center pt-4">
            <div class="flex flex-col justify-center items-center">
                <h2 class="text-gray-700 text-2xl pb-2">Example App</h2>
                <click-counter></click-counter>
                <modal 
                    name="test"
                    width="medium"
                    background="light">
                    <template v-slot:modal-button>
                        <span class="btn-gray-primary m-4">Open Modal</span>
                    </template>
                    <template v-slot:header>
                        <span>Header</span>
                    </template>
                    <template v-slot:body>
                        <div class="flex flex-col">
                            <span class="p-4 h-80">Body</span>
                            <span class="p-4 h-80">Body</span>
                            <span class="p-4 h-80">Body</span>
                            <span class="p-4 h-80">Body</span>
                        </div>
                    </template>
                    <template v-slot:footer>
                        <span class="p-4">footer</span>
                    </template>
                </modal>
            </div>
        </div>
    </div>
</x-guest-layout>