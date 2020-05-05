import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    // $employee :{ "view": null, "add": null, "edit": null, "delete": null, "search": null }
    test: "Test",
    

  },
  getters: {
    getTest(state) {
      return state.test;
    }
  },
  mutations: {
  },
  actions: {
    addTodo(context, param) {
      alert("From Store Actions : " + param);
    }
  },
  modules: {
  }
})
