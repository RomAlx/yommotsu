import '../bootstrap.js';
import { createApp } from 'vue';
import PayMainSecretComponent from '../components/paySecret/PaySecretMainComponent.vue';
import components from '../components/UI/index.js';

const PaySecret = createApp(PayMainSecretComponent);

components.forEach(component => {
    PaySecret.component(component.name, component);
});

PaySecret.mount('#pay-secret');
