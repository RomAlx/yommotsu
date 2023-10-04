import '../bootstrap.js';
import { createApp } from 'vue';
import FAQComponent from '../components/FAQ/FAQComponent.vue';
import components from '../components/UI/index.js';

const FAQ = createApp(FAQComponent);

components.forEach(component => {
    FAQ.component(component.name, component);
});

FAQ.mount('#faq');