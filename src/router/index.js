import Vue from "vue";
import VueRouter from "vue-router";
import Dashboard from "../components/Dashboard.vue";
import Login from "../components/Login.vue";
// import Project from "../components/Project.vue";
import Project from "../components/project/Project.vue";
import Employee from "../components/employee/Employee.vue";
import Home from "../components/Home.vue";
import EmployeeSearch from "../components/employee/EmployeeSearch.vue";
import Empdetail from "../components/employee/Empdetail.vue";
import ProjectSearch from "../components/project/ProjectSearch.vue";
import Prodetail from "../components/project/Prodetail.vue";

//import Home from "../views/Home.vue";
//FOR REFRESH .htaccess file added 
//https://forum.vuejs.org/t/404-when-hitting-refresh-in-a-router-component/27431

Vue.use(VueRouter);

const routes = [
  // {
  //   path: "/",
  //   name: "Home",
  //   component: Home
  // },
  {
    path: "/",
    name: "login",
    component: Login
  },
  {
    path: "/dashboard",
    name: "dashboard",
    component: Dashboard,
    children: [
      {
        path: "/dashboard/home",
        name: "home",
        component: Home
      },
      {
        path: "/dashboard/employee",
        name: "employee",
        component: Employee
      },
      {
        path: "/dashboard/employeesearch",
        name: "employeesearch",
        component: EmployeeSearch
      },
      {
        path: "/dashboard/project",
        name: "project",
        component: Project
      },
      {
        path: "/dashboard/projectsearch",
        name: "projectsearch",
        component: ProjectSearch
      },
      {
        path: "/dashboard/empdetail",
        name: "empdetail",
        component: Empdetail
      },
      {
        path: "/dashboard/prodetail",
        name: "prodetail",
        component: Prodetail
      }
    ]
  },
  {
    path: "/about",
    name: "About",
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () =>
      import(/* webpackChunkName: "about" */ "../views/About.vue")
  }
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes
});

export default router;
