import './bootstrap';
import { createApp } from 'vue';
import router from './router';

const app = createApp({});

import Home from './views/Home.vue';
app.component('home-component', Home);
app.use(router);


app.mount('#app');
