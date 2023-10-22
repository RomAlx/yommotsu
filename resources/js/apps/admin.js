import '../bootstrap.js';
import { createApp } from 'vue';
import AdminMainComponent from '../components/admin/AdminMainComponent.vue';

import components from '../components/UI/index.js';

const Admin = createApp(AdminMainComponent);

components.forEach(component => {
    Admin.component(component.name, component);
});

Admin.mount('#admin');