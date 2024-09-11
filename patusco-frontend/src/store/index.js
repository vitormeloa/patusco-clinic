import {createStore} from "vuex";

export default createStore({
  state: {
    isAuthenticated: !!localStorage.getItem('auth_token'),
  },
  mutations: {
    setAuthenticated(state, isAuthenticated) {
      state.isAuthenticated = isAuthenticated;
    },
  },
  actions: {
    login({ commit }, token) {
      localStorage.setItem('auth_token', token);
      commit('setAuthenticated', true);
    },
    logout({ commit }) {
      localStorage.removeItem('auth_token');
      commit('setAuthenticated', false);
      this.$router.push({ name: 'Login' });
    }
  },
  getters: {
    isAuthenticated: state => state.isAuthenticated,
  }
});
