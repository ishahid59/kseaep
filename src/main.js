import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import axios from 'axios'
import moment  from 'moment'



Vue.config.productionTip = false
Vue.prototype.$axios = axios
Vue.prototype.$moment = moment
// Vue.prototype.$moment = moment
// Vue.prototype.$host = "http://localhost:8000/"
 Vue.prototype.$host = "http://localhost:5000/" //for local node
// Vue.prototype.$host = "https://ksepnode.herokuapp.com/";//For Node Js Heroku 
// Vue.prototype.$host = "https://aepnode.herokuapp.com/";//For Node Js Heroku with MSSQL

//For Permission
// Vue.prototype.$employee = { "view": 0, "add": 0, "edit": 0, "delete": 0, "search": 0 }
// Vue.prototype.$project = { "view": 0, "add": 0, "edit": 0, "delete": 0, "search": 0 }
// Vue.prototype.$listitems = { "view": 0, "add": 0, "edit": 0, "delete": 0, "search": 0 }

// Vue.prototype.$username = localStorage.getItem("username")
//Vue.prototype.$host = "http://fshahidksep.000webhostapp.com/"
// Vue.prototype.$apitoken = "Bearer" + localStorage.getItem('token')
// var apitoken = "Bearer " + localStorage.getItem('token')
// axios.defaults.headers.common['Authorization'] = apitoken
// axios.defaults.headers.common['Accept'] = "application/json"

// const config = {headers:{
//   Authorization: "Bearer " + localStorage.getItem('token'),
//   Accept : "application/json"
// }}
Vue.prototype.$config = {
  headers: {
    Authorization: "Bearer " + localStorage.getItem('token'),
    Accept: "application/json"
  }
};


new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
