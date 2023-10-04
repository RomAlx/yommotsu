import '../bootstrap.js';
import { createApp } from 'vue';
import OrderStatusMainComponent from '../components/order_status/OrderStatusMainComponent.vue';

import components from '../components/UI/index.js';

const OrderStatus = createApp(OrderStatusMainComponent);

components.forEach(component => {
    OrderStatus.component(component.name, component);
});

OrderStatus.mount('#order-status');