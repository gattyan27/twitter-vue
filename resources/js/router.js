import Vue from 'vue';
import VueRouter from 'vue-router';

import Login from './pages/Login.vue';
import UserList from './pages/UserList.vue';
import TweetList from './pages/TweetList.vue';
import SystemError from './pages/errors/System.vue';
import TweetDetail from './pages/TweetDetail.vue';

import store from './store'

Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        component: TweetList
    },
    {
        path: '/tweets/:id',
        component: TweetDetail,
        props: true
    },
    {
        path: '/login',
        component: Login,
        beforeEnter: (to, from, next) => {
            if (store.getters['auth/check']) {
                next('/')
            } else {
                next()
            }
        }
    },
    {
        path: '/users',
        component: UserList
    },
    {
        path: '/500',
        component: SystemError
    }
];

const router = new VueRouter({
    mode: 'history',
    routes
});

export default router;