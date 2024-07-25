import { createStore } from 'vuex';

export default createStore({
    state() {
        return {
            isAuthenticated: !!localStorage.getItem('jfc-token')
        };
    },
    mutations: {
        setAuthentication(state, status) {
            state.isAuthenticated = status;
        }
    },
    actions: {
        login({ commit }, token) {
            localStorage.setItem('jfc-token', token);
            commit('setAuthentication', true);
        },
        logout({ commit }) {
            localStorage.removeItem('jfc-token');
            commit('setAuthentication', false);
        }
    }
});