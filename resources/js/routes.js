import VueRouter from 'vue-router';
import Dashboard from './pages/dashboard/Panel'
import Profile from './pages/profile/Profile'
import Users from './pages/users/Users'
import Type from './pages/type/Type'
import Content from './pages/content/Content'
import Login from './pages/auth/Login'
import NotFound from './pages/404/NotFound'
import doesCookieExist from './helpers/CookieCheck';
import Logout from './pages/auth/Logout'
import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const routes = [
    {
        path: '/',
        name: 'dashboard',
        component: Dashboard,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/profile',
        name: 'profile',
        component: Profile,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/users',
        name: 'users',
        component: Users,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/type',
        name: 'type',
        component: Type,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/content/:type',
        component: Content,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '*',
        component: NotFound,
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
    },
    {
        path: '/logout',
        name: 'logout',
        component: Logout,
        meta: {
            requiresAuth: true
        }
    }
];

const router = new VueRouter({
    routes,
    mode: 'history'
});

router.beforeEach(async (to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (doesCookieExist('token') && to.path !== '/login') {
            if (Object.keys(router.app.$store.state.user).length <= 0) {
                router.app.$store.dispatch('getUser');
            }
            next();
        } else {
            next({name:'login'});
        }
    } else {
        next();
    }


});

export default router;