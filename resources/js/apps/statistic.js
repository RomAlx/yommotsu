import '../bootstrap.js';
import { createApp } from 'vue';
import PayStatisticMainComponent from '../components/payStatistic/PayStatisticMainComponent.vue';

import components from '../components/UI/index.js';

const PayStatistic = createApp(PayStatisticMainComponent);

components.forEach(component => {
    PayStatistic.component(component.name, component);
});

PayStatistic.mount('#pay-statistic');
