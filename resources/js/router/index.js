import { createRouter, createWebHistory  } from "vue-router";
import user from './users.js';

const routes = [...user];

const router = createRouter({
    history: createWebHistory (),
    routes,
})

export default router;