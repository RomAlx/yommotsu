import '../bootstrap.js';
import { createApp } from 'vue';
import AuthComponent from '../components/auth/AuthComponent.vue';

import components from '../components/UI/index.js';

const Auth = createApp(AuthComponent);

components.forEach(component => {
    Auth.component(component.name, component);
});

Auth.mount('#auth');