import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import store from './store';
import 'vuetify/styles';
import { createVuetify } from 'vuetify';
import './assets/global.css';

import '@mdi/font/css/materialdesignicons.css';
import 'roboto-fontface/css/roboto/roboto-fontface.css';

const vuetify = createVuetify();

const app = createApp(App);

app.use(router);
app.use(store);
app.use(vuetify);
app.mount('#app');
