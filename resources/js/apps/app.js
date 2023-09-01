import '../bootstrap.js';
import { createApp } from 'vue';
import PayStatisticMainComponent from '../components/payStatistic/PayStatisticMainComponent.vue';
import PayMainComponent from '../components/pay/PayMainComponent.vue';
import PayMainStaticComponent from '../components/payStatic/PayStaticMainComponent.vue';
import PayMainSecretComponent from '../components/paySecret/PaySecretMainComponent.vue';
import PayTerminalComponent from '../components/paymentTerminal/Main.vue';

import components from '../components/UI/index.js';

const Pay = createApp(PayMainComponent);
const PaySecret = createApp(PayMainSecretComponent);
const PayStatic = createApp(PayMainStaticComponent);
const PayStatistic = createApp(PayStatisticMainComponent);
const PayTerminal = createApp(PayTerminalComponent);

components.forEach(component => {
    Pay.component(component.name, component);
    PaySecret.component(component.name, component);
    PayStatic.component(component.name, component);
    PayStatistic.component(component.name, component);
    PayTerminal.component(component.name, component);
});

Pay.mount('#pay');
PayStatic.mount('#pay-static');
PaySecret.mount('#pay-secret');
PayStatistic.mount('#pay-statistic');
PayTerminal.mount('#pay-terminal');
