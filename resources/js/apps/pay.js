import '../bootstrap.js';
import { createApp } from 'vue';
import PayMainComponent from '../components/pay/PayMainComponent.vue';

import components from '../components/UI/index.js';

const Pay = createApp(PayMainComponent);

components.forEach(component => {
    Pay.component(component.name, component);
});

Pay.mount('#pay');