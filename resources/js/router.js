import { createRouter, createWebHistory } from 'vue-router';

import Business from './components/Business/Business.vue';
import Tasks from './components/Tasks/Tasks.vue';
import People from './components/People/People.vue';
import Tags from './components/Tags/Tags.vue';
import Categories from './components/Categories/Categories.vue';
import Login from './components/Login.vue';

const routes = [
    { path: '/', component: Login },
    { path: '/business', component: Business },
    { path: '/tasks', component: Tasks },
    { path: '/people', component: People },
    { path: '/tags', component: Tags },
    { path: '/categories', component: Categories },
    { path: '/login', component: Login },
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;