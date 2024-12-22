import './bootstrap';
import { createApp } from 'vue';
import router from './router';
import store from './store'; 
import axios from './axios'; 

const app = createApp({});

// import Home from './views/Home.vue';
// app.component('home-component', Home);
app.use(router);
app.use(store);
app.config.globalProperties.$axios = axios;

app.mount('#app');
