import { createApp } from 'vue';
import Header from './components/Header.vue';
import router from './router';
import '../css/app.css';

const app = createApp({});

app.component('header-component', Header);
app.use(router);
app.mount('#app');