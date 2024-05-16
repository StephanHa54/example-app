import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import { createApp } from 'vue/dist/vue.esm-bundler';

// import VueClip from 'vue-clip';
/**
 * Utilities 
 */
import ClickCounter from './components/ClickCounter.vue';
import Modal from './components/utilities/Modal.vue';
import TopNavMenu from './components/utilities/nav/TopNavMenu.vue';
/**
 * profile 
 */
import Avatar from './components/profile/Avatar.vue';
import Profile from './components/profile/Profile.vue';
import Password from './components/profile/Password.vue';

const app = createApp({})

// app.component('VueClip', VueClip)
// app.use(VueClip)
/**
 * Utilities
 */
app.component('ClickCounter', ClickCounter)
app.component('Modal', Modal)
app.component('TopNavMenu', TopNavMenu)
/**
 * profile 
 */
app.component('Avatar', Avatar)
app.component('Profile', Profile)
app.component('Password', Password)

app.mount('#app')