<template>
    <div>
        <button @click="counter++" class="btn-primary-accent">
            Click Counter: {{ counter }}
        </button>
    </div>
</template>
    
<script>
    export default { 
        data() {
            return { counter: 0 }
        }  
    }
</script>