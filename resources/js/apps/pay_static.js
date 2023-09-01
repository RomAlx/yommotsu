import '../bootstrap.js';
import { createApp } from 'vue';
import PayMainStaticComponent from '../components/payStatic/PayStaticMainComponent.vue';

import components from '../components/UI/index.js';

const PayStatic = createApp(PayMainStaticComponent);

components.forEach(component => {
    PayStatic.component(component.name, component);
});

PayStatic.mount('#pay-static');