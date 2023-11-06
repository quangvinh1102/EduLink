import './bootstrap';
import { createApp } from 'vue';
import router from './router/index.js';
import App from './App.vue';
import Antd from "ant-design-vue";
import axios from "axios";
window.axios = axios;
axios.defaults.baseURL = "http://127.0.0.1:8000";

import 'ant-design-vue/dist/reset.css';
import "./static/fontawesome/css/all.min.css";
import "bootstrap/dist/css/bootstrap-grid.min.css";
import "bootstrap/dist/css/bootstrap-utilities.min.css";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.bundle.min.js";


const app = createApp(App);
app.use(router);
app.use(Antd);
app.mount("#app");
