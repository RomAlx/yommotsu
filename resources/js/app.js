import './bootstrap.js';
import { createApp } from 'vue';
import PayStatisticMainComponent from './components/payStatistic/PayStatisticMainComponent.vue';
import PayMainComponent from './components/pay/PayMainComponent.vue';
import PayMainStaticComponent from './components/payStatic/PayStaticMainComponent.vue';


createApp(PayMainComponent).mount('#pay');
createApp(PayMainStaticComponent).mount('#pay-static');
createApp(PayStatisticMainComponent).mount('#pay-statistic');
