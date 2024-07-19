import { createRouter, createWebHistory } from 'vue-router';

import Business from './components/Business/Business.vue';
import AddBusiness from './components/Business/AddBusiness.vue';
import EditBusiness from './components/Business/EditBusiness.vue';
import Tasks from './components/Tasks/Tasks.vue';
import People from './components/People/People.vue';
import Tags from './components/Tags/Tags.vue';
import AddTag from './components/Tags/AddTag.vue';
import EditTag from './components/Tags/EditTag.vue';
import Categories from './components/Categories/Categories.vue';
import AddCategory from './components/Categories/AddCategory.vue';
import EditCategory from './components/Categories/EditCategory.vue';
import Login from './components/Login.vue';

const routes = [
    { 
        path: '/', 
        component: Login 
    },
    { 
        path: '/business', 
        component: Business 
    },
    { 
        path: '/business/add', 
        component: AddBusiness 
    },
    { 
        path: '/business/:id/edit',
         component: EditBusiness 
    },
    { 
        path: '/tasks', 
        component: Tasks 
    },
    { 
        path: '/people', 
        component: People 
    },
    { 
        path: '/tags', 
        component: Tags 
    },
    { 
        path: '/tags/add', 
        component: AddTag 
    },
    { 
        path: '/tags/:id/edit',
         component: EditTag 
    },
    { 
        path: '/categories', 
        component: Categories 
    },
    { 
        path: '/categories/add', 
        component: AddCategory 
    },
    { 
        path: '/categories/:id/edit',
         component: EditCategory 
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

export default router;