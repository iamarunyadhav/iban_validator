import { createStore } from 'vuex';
import axios from 'axios';

export default createStore({
  state: {
    isAuthenticated: false
  },
  mutations: {
    setAuthentication(state, status) {
      state.isAuthenticated = status;
    }
  },
  actions: {
    logout({ commit }) {
      axios.post('http://127.0.0.1:8000/api/vi/logout')
        .then(() => {
          commit('setAuthentication', false);
          // Optionally handle other cleanup tasks
        })
        .catch(error => {
          console.error('Logout failed:', error);
        });
    }
  },
  getters: {
    isAuthenticated: state => state.isAuthenticated
  }
});
