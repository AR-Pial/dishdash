import { createStore } from 'vuex';

const store = createStore({
  modules: {
    home: {
      namespaced: true,  // Make sure the module is namespaced
      state: () => ({
        message: 'Hello from the Home Module - vuex!',
      }),
      mutations: {
        setMessage(state, newMessage) {
          state.message = newMessage;
        },
      },
      actions: {
        updateMessage({ commit }, newMessage) {
          commit('setMessage', newMessage);
        },
      },
      getters: {
        getHomeMessage(state) {
          return state.message;
        },
      },
    },
    about: {
      namespaced: true,  // Make sure the module is namespaced
      state: () => ({
        message: 'Hello from the About Module - vuex!',
      }),
      mutations: {
        setMessage(state, newMessage) {
          state.message = newMessage;
        },
      },
      actions: {
        updateMessage({ commit }, newMessage) {
          commit('setMessage', newMessage);
        },
      },
      getters: {
        getAboutMessage(state) {
          return state.message;
        },
      },
    },
  },
});

export default store;
