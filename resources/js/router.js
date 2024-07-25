import { createRouter, createWebHistory } from 'vue-router';

import Business from './components/Business/Business.vue';
import AddBusiness from './components/Business/AddBusiness.vue';
import EditBusiness from './components/Business/EditBusiness.vue';
import Tasks from './components/Tasks/Tasks.vue';
import AddTask from './components/Tasks/AddTask.vue';
import People from './components/People/People.vue';
import AddPeople from './components/People/AddPeople.vue';
import EditPeople from './components/People/EditPeople.vue';
import Tags from './components/Tags/Tags.vue';
import AddTag from './components/Tags/AddTag.vue';
import EditTag from './components/Tags/EditTag.vue';
import Categories from './components/Categories/Categories.vue';
import AddCategory from './components/Categories/AddCategory.vue';
import EditCategory from './components/Categories/EditCategory.vue';
import Login from './components/Login.vue';
import Register from './components/Register.vue';

const routes = [
    { 
        path: '/', 
        component: Login 
    },
    { 
        path: '/register', 
        component: Register 
    },
    { 
        path: '/business', 
        component: Business,
        meta: { requiresAuth: true } 
    },
    { 
        path: '/business/add', 
        component: AddBusiness,
        meta: { requiresAuth: true } 
    },
    { 
        path: '/business/:id/edit',
        component: EditBusiness,
        props: true,
        meta: { requiresAuth: true }  
    },
    { 
        path: '/tasks', 
        component: Tasks,
        meta: { requiresAuth: true } 
    },
    { 
        path: '/tasks/add', 
        component: AddTask,
        meta: { requiresAuth: true } 
    },
    { 
        path: '/people', 
        component: People,
        meta: { requiresAuth: true } 
    },
    { 
        path: '/people/add', 
        component: AddPeople,
        meta: { requiresAuth: true } 
    },
    { 
        path: '/people/:id/edit', 
        component: EditPeople,
        props: true,
        meta: { requiresAuth: true } 
    },
    { 
        path: '/tags', 
        component: Tags,
        meta: { requiresAuth: true } 
    },
    { 
        path: '/tags/add', 
        component: AddTag,
        meta: { requiresAuth: true } 
    },
    { 
        path: '/tags/:id/edit',
        component: EditTag,
        props: true,
        meta: { requiresAuth: true } 
    },
    { 
        path: '/categories', 
        component: Categories,
        meta: { requiresAuth: true } 
    },
    { 
        path: '/categories/add', 
        component: AddCategory,
        meta: { requiresAuth: true } 
    },
    { 
        path: '/categories/:id/edit',
        component: EditCategory,
        props: true,
        meta: { requiresAuth: true } 
    },
    { 
        path: '/login', 
        component: Login 
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        const token = localStorage.getItem('jfc-token');
        if (!token) {
            next({
                path: '/login',
                query: { redirect: to.fullPath }
            });
        } else {
            next();
        }
    } else {
        next();
    }
});

export default router;