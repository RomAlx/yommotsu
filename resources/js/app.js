import './bootstrap.js';
import { createApp } from 'vue';
import PayStatisticMainComponent from './components/payStatistic/PayStatisticMainComponent.vue';
import PayMainComponent from './components/pay/PayMainComponent.vue';


createApp(PayMainComponent).mount('#pay');
createApp(PayStatisticMainComponent).mount('#pay-statistic');