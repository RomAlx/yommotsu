import '../bootstrap.js';
import { createApp } from 'vue';
import MainComponent from '../components/main/MainComponent.vue';
import components from '../components/UI/index.js';

const Main = createApp(MainComponent);

components.forEach(component => {
    Main.component(component.name, component);
});

Main.mount('#main');