import VueRouter from 'vue-router';
import Dashboard from './pages/dashboard/Panel'
import Profile from './pages/profile/Profile'
import Users from './pages/users/Users'
import Settings from './pages/settings/Settings'
import Login from './pages/auth/Login'

const routes = [
    {
        path: '/',
        name: 'dashboard',
        component: Dashboard
    },
    {
        path: '/profile',
        name: 'profile',
        component: Profile
    },
    {
        path: '/users',
        name: 'users',
        component: Users
    },
    {
        path: '/settings',
        name: 'settings',
        component: Settings
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