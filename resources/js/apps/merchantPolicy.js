import '../bootstrap.js';
import { createApp } from 'vue';
import MerchantPolicyComponent from '../components/merchantPolicy/merchantPolicyComponent.vue';
import components from '../components/UI/index.js';

const MerchantPolicy = createApp(MerchantPolicyComponent);

components.forEach(component => {
    MerchantPolicy.component(component.name, component);
});

MerchantPolicy.mount('#merchantPolicy');