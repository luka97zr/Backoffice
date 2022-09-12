import axios from "axios";

export default {
    state: {
        roles: [],
        user: {},
        loggedIn: false,
    },
    mutations: {
        setState(state, payload) {
            state.roles = payload;
        },
        setUser(state, payload) {
            state.user = payload;
        },
        setLoggedIn(state, payload) {
            state.loggedIn = payload;
        }
    },
    actions: {
        async getRoles({commit}) {
            try {
                const roles = (await axios.get('/api/role')).data;
                commit('setState', roles);
            } catch(error) {
                console.log(error);
            }
        },
        async getUser({commit}) {
            try {
                const user = (await axios.get('/api/authUser')).data;
                commit('setUser', user);
            } catch (error) {
                console.log(error);
            }
        }
    }
}