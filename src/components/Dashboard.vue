<template>

  <div class="wrapper" >
    <!-- Main Header -->
    <header class="main-header">
      <!-- Logo -->
      <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
          <b>A</b>LT
        </span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
          <b>Admin</b>LTE
        </span>
      </a>

      <!-- Header Navbar -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li>
              <!-- Menu toggle button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-fw fa-user-o"></i>
                <span>{{username}}</span>
              </a>
            </li>
            <li>
              <!-- Menu toggle button -->
              <a  @click="logout()" href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-fw fa-power-off"></i>
                <span>Logout</span>
              </a>
            </li>

            <!-- Control Sidebar Toggle Button -->
          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
          <!-- <li style="margin-top:30px; margin-bottom:30px" class="header">LEFT MENU BAR</li> -->
          <li class="header" style="font-weight: bold; color: rgb(184, 199, 206); font-size: 12px; margin-top: 10px; margin-bottom: 40px;"></li>
          <!-- Optionally, you can add icons to the links -->
         <li>
            <router-link to="/dashboard/home">
              <i class="fa fa-fw fa-file " style="margin-right:8px"></i>
              <span>Home</span>
            </router-link>
          </li>
          <li>
            <router-link to="/dashboard/employee">
              <i class="fa fa-fw fa-file " style="margin-right:5px"></i>
              <span>
                Employee List
              </span>
            </router-link>
          </li>
          <li>
            <router-link to="/dashboard/project">
              <i class="fa fa-fw fa-file " style="margin-right:8px"></i>
              <span>Project List</span>
            </router-link>
          </li>
           <li>
            <router-link to="/dashboard/employeesearch">
              <i class="fa fa-fw fa-file " style="margin-right:5px"></i>
              <span>
                Employee Search
              </span>
            </router-link>
          </li>
           <li>
            <router-link to="/dashboard/projectsearch">
              <i class="fa fa-fw fa-file " style="margin-right:5px"></i>
              <span>
                Project Search
               
              </span>
            </router-link>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-folder" style="margin-right:8px"></i>
              <span>List Items</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li>
                <a href="#">Employee Jobitle</a>
              </li>
              <li>
                <a href="#">Employee Registration</a>
              </li>
            </ul>
          </li>
        </ul>
        <!-- /.sidebar-menu -->
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="background-color:white">
      <!-- Content Header (Page header) -->
      <!-- <section class="content-header">
        <h1>
          Page Header
          <small>Optional description</small>
        </h1>
        <ol class="breadcrumb">
          <li>
            <a href="#">
              <i class="fa fa-dashboard"></i> Level
            </a>
          </li>
          <li class="active">Here</li>
        </ol>
      </section> -->

      <!-- Main content -->
      <section class="content container-fluid" style="background-color:white; padding-left:30px; padding-top:15px" >
        <!--------------------------
        | Your Page Content Here |
        -------------------------->

        <router-view  :key="$route.fullPath"/>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer" style="background-color:white">
      <!-- To the right -->
      <!-- <div class="pull-right hidden-xs">Anything you want</div> -->
      <!-- Default to the left -->
      <strong>
        Copyright &copy; 2020
        <a href="#" style="color:#3097D1">Farhan Shahid</a>.
      </strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Create the tabs -->
      <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li class="active">
          <a href="#control-sidebar-home-tab" data-toggle="tab">
            <i class="fa fa-home"></i>
          </a>
        </li>
        <li>
          <a href="#control-sidebar-settings-tab" data-toggle="tab">
            <i class="fa fa-gears"></i>
          </a>
        </li>
      </ul>
      <!-- Tab panes -->
      <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane active" id="control-sidebar-home-tab">
          <h3 class="control-sidebar-heading">Recent Activity</h3>
          <ul class="control-sidebar-menu">
            <li>
              <a href="javascript:;">
                <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                <div class="menu-info">
                  <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                  <p>Will be 23 on April 24th</p>
                </div>
              </a>
            </li>
          </ul>
          <!-- /.control-sidebar-menu -->

          <h3 class="control-sidebar-heading">Tasks Progress</h3>
          <ul class="control-sidebar-menu">
            <li>
              <a href="javascript:;">
                <h4 class="control-sidebar-subheading">
                  Custom Template Design
                  <span class="pull-right-container">
                    <span class="label label-danger pull-right">70%</span>
                  </span>
                </h4>

                <div class="progress progress-xxs">
                  <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                </div>
              </a>
            </li>
          </ul>
          <!-- /.control-sidebar-menu -->
        </div>
        <!-- /.tab-pane -->
        <!-- Stats tab content -->
        <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
        <!-- /.tab-pane -->
        <!-- Settings tab content -->
        <div class="tab-pane" id="control-sidebar-settings-tab">
          <form method="post">
            <h3 class="control-sidebar-heading">General Settings</h3>

            <div class="form-group">
              <label class="control-sidebar-subheading">
                Report panel usage
                <input type="checkbox" class="pull-right" checked />
              </label>

              <p>Some information about this general settings option</p>
            </div>
            <!-- /.form-group -->
          </form>
        </div>
        <!-- /.tab-pane -->
      </div>
    </aside>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
    immediately after the control sidebar-->
    <div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->
</template>

<script>
export default {
  name: "admin",
  data() {
    return {
      username: localStorage.getItem("username")
    };
  },
  methods: {
    logout() {
      //Todo: Clear JWT Token from local storage
      // localStorage.setItem("token", "");
      //localStorage.setItem("username", "");

      localStorage.removeItem("username");
      localStorage.removeItem("token");
      this.$router.push({ name: "login" });
    }
  },
  mounted() {

    // //Authorization Checked in Dashboard for all Children
    // if (localStorage.getItem("token") == null) {
    //   this.$router.push({ name: "login" });
    // }


    // if (localStorage.getItem("token") == "") {
    
    //WE closed Token for Testing Heroku
    //   if (localStorage.getItem("token") == null) {
    //   this.$router.push({ name: "login" });
    //   this.username=localStorage.getItem("username");
    // }
  }
};
</script>
<style scoped>
.testdiv2 {
  margin: 0;
  padding: 0;
  /* height:100%; */
  width: 100%;
  height: 100%;
  position: fixed;
  background-color: black;
  opacity: 0.3;
  /* src="../../public/img/loading.gif" */
  /* background-image: url(../../public/img/loading.gif); */
  background-position: center;
  /* background-repeat: no-repeat; */
}

a,
a:visited {
  color: lightgray;
}

li {
  margin-top: 0px;
}

a:hover {
  text-decoration: none;
}

/* a:visited{
        color: lightgray;
    } */

/* For AdminLTE Sidebar */
.skin-blue .sidebar a{
  color: #b8c7ce;
}
.router-link-exact-active{
  background-color: #367dA9;
  color: white !important;
}

.router-link-exact-active:hover{
  background-color: #367dA9 !important;
  color: white !important;
}
</style>
