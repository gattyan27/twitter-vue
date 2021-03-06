import Vue from 'vue';
import VueRouter from 'vue-router';

import Login from './pages/Login.vue';
import UserList from './pages/UserList.vue';
import TweetList from './pages/TweetList.vue';

Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        component: TweetList
    },
    {
        path: '/login',
        component: Login
    },
    {
        path: '/users',
        component: UserList
    },
];

const router = new VueRouter({
    mode: 'history',
    routes
});

export default router;