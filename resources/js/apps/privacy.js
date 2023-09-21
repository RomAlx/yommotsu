import '../bootstrap.js';
import { createApp } from 'vue';
import PrivacyComponent from '../components/privacyPolicy/PrivacyComponent.vue';
import components from '../components/UI/index.js';

const Privacy = createApp(PrivacyComponent);

components.forEach(component => {
    Privacy.component(component.name, component);
});

Privacy.mount('#privacy');