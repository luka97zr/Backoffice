import VueRouter from 'vue-router';
import Dashboard from './pages/dashboard/Panel'
import Profile from './pages/profile/Profile'
import Users from './pages/users/Users'
import Settings from './pages/settings/Settings'
import Login from './pages/auth/Login'
import NotFound from './pages/404/NotFound'

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
        path: '/settings',
        name: 'settings',
        component: Settings,
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
        component: Login
    }
];
const router = new VueRouter({
    routes,
    mode: 'history'
});

export default router;