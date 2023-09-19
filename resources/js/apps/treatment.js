import '../bootstrap.js';
import { createApp } from 'vue';
import TreatmentComponent from '../components/treatment/TreatmentComponent.vue';
import components from '../components/UI/index.js';

const Treatment = createApp(TreatmentComponent);

components.forEach(component => {
    Treatment.component(component.name, component);
});

Treatment.mount('#treatment');