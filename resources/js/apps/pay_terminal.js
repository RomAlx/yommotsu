import '../bootstrap.js';
import { createApp } from 'vue';
import PayTerminalComponent from '../components/paymentTerminal/Main.vue';

import components from '../components/UI/index.js';

const PayTerminal = createApp(PayTerminalComponent);

components.forEach(component => {
    PayTerminal.component(component.name, component);
});

PayTerminal.mount('#pay-terminal');
