<!DOCTYPE html>
<html >

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- <title>AdminLTE 2 | Starter</title> -->
  <title>KSE | Ksep</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- <meta id="token" name="token" value="{{ csrf_token() }}"> -->
  <!-- Styles -->


  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <!-- put bootstrap version required for after asset('css/app.css') to override the default version with nodemodule -->
  <!-- <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> 
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css"> -->
  <!-- <link rel="stylesheet" href="hhttps://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="hhttps://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css"> -->
 
  <!-- <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'> -->
  <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <!--  needed for web deploy since cannot find saas path for bootstrap-glyphicons-->
  <!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet"> -->

  <!-- for datatable row select style-->
  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"> -->

  <!-- Export to xl-->
   <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">

<!-- Bootstrap Multiselect -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
<!-- Bootstrap selectpicker -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.10/css/bootstrap-select.css" />

<style>

/* datatable row select style */
table.dataTable tbody tr.selected {
    background-color: #fff7d1;
}

table.dataTable.no-footer {
    border-bottom: 1px solid #c3c3c3;
}

/* .modal-backdrop
{
    opacity:0.2 !important;
} */
/* https://stackoverflow.com/questions/28096346/how-to-change-background-opacity-when-bootstrap-modal-is-open */
.modal-backdrop{
  opacity:0; transition:opacity .2s;
}
.modal-backdrop.in{
  opacity:.2;
 
}

/* to remove the top light shadow */
/* .form-control {
  -webkit-box-shadow:inset 0 0px 0px rgba(0, 0, 0, 0.075) !important;
} */


.swal2-popup {
  /* font-size: 1.6rem !important; */
  font-size: 14px !important;
}

#app {
  /* font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: left; */

  /* color: #2c3e50; */

  /* margin-top: 60px; */
  font-family:"Helvetica",Arial,sans-serif;
}

td > a {
  color:#006fae;
  text-decoration: none;
}
h2{
  color:black;
}
#save{
    background-color: #2a88bd;
}

/* validation error under all input where error div class is .error */
.error{
  font-size:13px;
  padding-left:10px;
  padding-top:2px;
}
/* common top error bar styles  */
.toperrbar{
  height:0px;
  height:0px;
  background-color:#f2dede;
  color:#a94442;
  border-color:#ebccd1;
  /* margin-top:10px; */
  transition: height 300ms;
  display:block;
}
.toperrbar ul{
  padding-top:10px;
}


/* bootstrap select style use it here to override bootstrap default*/
/* ********************************************************************************************************** */


/* .bootstrap-select .dropdown-toggle .filter-option-inner-inner {
    font-size: 14px;
}

.bootstrap-select > .dropdown-toggle.bs-placeholder, .bootstrap-select > .dropdown-toggle.bs-placeholder:hover, .bootstrap-select > .dropdown-toggle.bs-placeholder:focus, .bootstrap-select > .dropdown-toggle.bs-placeholder:active{
  height:30px;
  padding-top:2px;
  margin-top:5px;
  font-size:14px;
}
.bootstrap-select .dropdown-toggle .filter-option-inner-inner {
  padding=0;
} */


/* data-style="btn-sm"  is used in template so fontsize became smaller. So make fontsize bigger */
.bootstrap-select > .dropdown-toggle.bs-placeholder, .bootstrap-select > .dropdown-toggle.bs-placeholder:hover, .bootstrap-select > .dropdown-toggle.bs-placeholder:focus, .bootstrap-select > .dropdown-toggle.bs-placeholder:active{
  font-size:14px;
  height:32px;
  padding-top:4px;

}
.bootstrap-select > .dropdown-toggle {
  font-size:14px;
  height:32px;
  padding-top:4px
}


/* row height */
.bootstrap-select .dropdown-menu li a {
 padding-top :1px;
 padding-bottom :1px;
 font-size:13px;
}

/* searchbox height of dropdown */
.bs-searchbox .form-control {
    margin-bottom: 0;
    /* width: 100%; */
    float: none;
    height:30px;
}

/* to expand the dropdown menu on left instead of right */
.dropdown-menu {
    right: 0;
    left: auto;
}






/* Datatable Common styles********************************************************  */



/* row height */
table.dataTable tbody > tr > td {
  padding-top: 2px;
  padding-bottom: 2px;
}

.table > thead > tr > th,
.table > thead > tr > td,
.table > tbody > tr > th,
.table > tbody > tr > td,
.table > tfoot > tr > th,
.table > tfoot > tr > td {
  color: black;
  line-height: 22px;

}
.table > thead > tr {
  background-color:#f1f1f1;
  line-height:25px;
  font-size:13px; /* thead font size */
}
.table > thead > tr > th{
  border-bottom: 1px solid #cecece;
}
table.dataTable{
  border-color: #aeaeae;
}
table.dataTable

/* not working in common css so put inthe components */
/* class for processing img, to remove the box around the image */
.dataTables_processing{
  position: absolute;
  border: none;
  background: transparent;
}

.pagination > .active > a,
.pagination > .active > a:hover,
.pagination > .active > a:focus,
.pagination > .active > span,
.pagination > .active > span:hover,
.pagination > .active > span:focus {
  z-index: 3;
  color: #fff;
  cursor: default;
  background-color: #2a88bd;
  border-color: #2a88bd;
}

/*fontawsome integration for sort icons https://datatables.net/blog/2014-06-06 */
table.dataTable thead th {
    position: relative;
    background-image: none !important;
    line-height:20px;
}
table.dataTable thead th.sorting:after,
table.dataTable thead th.sorting_asc:after,
table.dataTable thead th.sorting_desc:after {
    position: absolute;
    top: 12px;
    right: 8px;
    display: block;
    font-family: FontAwesome;
}
table.dataTable thead th.sorting:after {
    content: "\f0dc";
    /* color: #ddd; */
    color: #000;
    font-size: 0.8em;
    padding-top: 0em;
    margin-top: -4px;
}
table.dataTable thead th.sorting_asc:after {
    content: "\f0de";
margin-top: -1px;
}
table.dataTable thead th.sorting_desc:after {
    content: "\f0dd";
    margin-top: -7px;
}

/* .dataTables_processing>img{
  margin-top: 150px;
} */

/* #employeeTable{
  background: url('/images/ajax-loader.gif') no-repeat top center;

} */








/*DATATABLE PREVIOUS Django deployment STYLES not used now */
/* ======================================================================= */

/* padding top in body is used since a static menubar is used */
/* body {
padding-top: 60px;
padding-bottom: 20px;
} */

/* to remove padding from datatable to align with container */
/* for this page only */
/* main datatable container */

/* #employeeTable_wrapper,
#projectTable_wrapper {
  padding-left: 1px;
  padding-right: 2px;
  padding-top: 10px;
  padding-bottom: 35px;
  border: 1px solid #ccc;
} */

  /* border-top: 1px solid #ccc; */
  /* border-right: 0;
    border-left: 0; */

  /* border-left: 1px solid #ccc;
    border-right: 1px solid #ccc;
    border-bottom: 1px solid #ccc; */


/* to hide border under the active tabs */

/* #empdegreeTable_wrapper,
#empregistrationTable_wrapper,
#proteamTable_wrapper {
  padding-top: 5px !important;
  padding-left: 2px;
  padding-right: 2px;
  border: 1px solid #ccc;
  padding-bottom: 30px;
  border-top: 0px solid #ccc;
} */

/* set the font size of datatables. Loading common heaader sometimes will not show font size */

/* #employeeTable,
#empdegreeTable,
#empregistrationTable,
#projectTable,
#proteamTable {
  font-size: 14px;
  margin-top: 2px !important;
} */

/* to override the width for datatable col widths which may go outside of border */
/* both for emplist and search table */

/* #employeeTable,
#projectTable {
  width: inherit !important;
}

#employeeTable_wrapper thead,
#projectTable_wrapper thead,
#empdegreeTable_wrapper thead,
#empregistrationTable_wrapper thead,
#proteamTable_wrapper thead {
  background-color: #eeeeee;
  font-family: Roboto;
  font-weight: bold;
  text-transform: uppercase;
  font-size: 11.5px;
  letter-spacing: -0px;
  color: #000000;
} */


/*END DATATABLE STYLES */
/* ======================================================================= */






</style>




</head>

<body class="hold-transition skin-blue sidebar-mini">
 <div class="wrapper" id="app" style="margin-top:0px;"> <!-- margin-top:0px; is needed to avoid 60px margin on top -->

    <!-- Main Header -->
    <header class="main-header">

      <!-- Logo -->
      <!-- <a href="index2.html" class="logo"> -->
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <!-- <span class="logo-mini"><b>A</b>LT</span> -->
        <!-- logo for regular state and mobile devices -->
        <!-- <span class="logo-lg"><b>Admin</b>LTE</span>
      </a> -->

      <!-- <a href="/home" class="logo"> -->
      <a href="/home" class="logo" style="text-align:left;">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <!-- <span class="logo-mini"><b><i>KSE</i></b></span> -->
        <span class="logo-mini"><b><i>KSEP</i></b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg" style="font-size:20px;margin-left:10px;"><b><i>KSE</i></b> projects</span>
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
              <a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="fa fa-fw fa-user-o"></i> 

              <!-- <span class="hidden-xs"> {{ Auth::user()->name }} </span></a> 
                   hidden span user_type and api_token is used to send data to vue through master.blade, 
                   Later with larave latest ver user can be passed to vue app with js code in this page
                   Laravel 5.7 ACL in Front-end Using Vue js https://www.youtube.com/watch?v=sW6MStdkFJE -->
              <span class="hidden-xs"> {{ Auth::user()->name }}</span><span id="hiddenusertype" hidden>{{ Auth::user()->user_type }}</span><span id="hiddenapitoken" hidden>{{ Auth::user()->api_token }}</span></a>
              
            </li>

            <li>
              <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="fa fa-fw fa-power-off"></i>Logout</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
              </form>
            </li>

          </ul>
        </div>
      </nav>
    </header>


    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

      <!-- sidebar: style can be found in sidebar.less -->
      <div class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
          <div class="pull-left image">
            <!--has to be dynamic image from database -->
            <!-- <img src="{{asset('images/avatar5.png')}}" class="img-circle" alt="User Image"> -->
          </div>
          <div class="pull-left info">
            <!-- <p >{{ Auth::user()->name }} </p> -->
            <!-- // to get username in vue component through id=username used for role -->
            <!-- <p id="username">{{ Auth::user()->name }} </p> -->
            

            <!--has to be dynamic Status -->
            <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
          </div>
        </div>

        <!-- search form (Optional) -->
        <!-- <form action="#" method="get" class="sidebar-form">
          <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
          </div>
        </form> -->
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">

          <!-- <li class="header">HEADER</li> -->
          <!-- <li class="header" style="font-weight:bold;color:#b8c7ce;font-size:12px;margin-top:10px;margin-bottom:10px;">MENU BAR</li> -->
          <li class="header" style="font-weight:bold;color:#b8c7ce;font-size:12px;margin-top:10px;margin-bottom:10px;"></li>
          
          <!-- Optionally, you can add icons to the links -->
         
          <li ><router-link to="/home" active><i class="fa fa-fw fa-file "></i> <span>Home</span></router-link></li>
          <li><router-link to="/employee"><i class="fa fa-fw fa-file "></i> <span>Employee List</span></router-link></li>
          <li><router-link to="/project"><i class="fa fa-fw fa-file "></i> <span>Project List</span></router-link></li>
          <li><router-link to="/employee_search"><i class="fa fa-fw fa-file "></i> <span>Employee Search</span></router-link></li>
          <li><router-link to="/project_search"><i class="fa fa-fw fa-file "></i> <span>Project Search</span></router-link></li>

          <!-- FOR WEB -->
          <!-- <li ><router-link to="/ksep/home" active><i class="fa fa-fw fa-file "></i> <span>Home</span></router-link></li>
          <li><router-link to="/ksep/employee"><i class="fa fa-fw fa-file "></i> <span>Employee</span></router-link></li>
          <li><router-link to="/ksep/employee_search"><i class="fa fa-fw fa-file "></i> <span>Employee Search</span></router-link></li>
          <li><router-link to="/ksep/project"><i class="fa fa-fw fa-file "></i> <span>Project</span></router-link></li>
          <li><router-link to="/ksep/project_search"><i class="fa fa-fw fa-file "></i> <span>Project Search</span></router-link></li> -->
          
          <li class="treeview">
            <a href="#"><i class="fa fa-fw fa-file"></i> <span>List Items</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="#">Link in level 2</a></li>
              <li><a href="#">Link in level 2</a></li>
              <li><a id="register" target="_blank">Link in level 2</a></li>
             
            </ul>
          </li>


        </ul>
        <!-- /.sidebar-menu -->
</div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="background:white">

      <!-- Content Header (Page header) -->
      <!-- Main content -->
      <div class="content ">
        <div class="container-fluid">
            <!-- image is preloaded for firsttime employee loading -->
            <div><img src="images/ajax-loader.gif" alt="" hidden></div>
          <!-- <router-view></router-view> -->
          <!-- this :key is used for fid by Employeeid in detail page to avoid whole page reload . This :key will  
          check for any change in route and remount the page without reloading. History is also preserved  -->
          <!-- https://laracasts.com/discuss/channels/vue/vue-2-reload-component-when-same-route-is-requested?page=1 -->
          <router-view :key="$route.fullPath"></router-view>

        </div><!-- /.container-fluid -->
     </div> <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->



    <!-- Main Footer -->
    <footer class="main-footer" style="padding-bottom:7px; padding-top:7px;">
      <!-- To the right -->
      <div class="pull-right hidden-xs">
        <!-- Anything you want -->
      </div>
      <!-- Default to the left -->
      <small>Copyright &copy; 2019 <a href="http://compulinkbd.com">Compulink International Ltd.</a> All rights reserved.</small> 
    </footer>


</div >
<!-- /.wrapper with app id-->


<script src="https://cdn.jsdelivr.net/vue.resource/1.0.3/vue-resource.min.js"></script>
<script src="{{asset('js/app.js')}}"></script>

<!-- put jquery and bootstrap version required for after asset('css/app.css') to override the default version with nodemodule -->
<!-- <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script> -->
  <!-- to avoid tooltip error -->
<!-- <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> -->

 
<!-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> -->

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>


<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<!-- Export to xl -->

<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> -->
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>

<!-- Bootstrap Multiselect -->
<!-- <script type="text/javascript" src="js/bootstrap-multiselect/bootstrap-multiselect.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<!-- Bootstrap selectpicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.10/js/bootstrap-select.js"></script>

<!-- <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script> -->
  <script>


    // this is used to change the id value of modal id field to use it in vue openempdetail method
    // first call the function setrowid() from datatable row then invoke a click event of hidden element in vue template
    //   function showempeditmodal(id) {
    //     $("#id").val(id); 
    //     $("#hiddenshoweditmodal").click();
    // }

    // function openempdetailpage(id) {
    //     $("#id").val(id); 
    //     $("#hiddenopendetailpage").click();
    // }

    // // EmpDegree
    // function showempdegreeeditmodal(id) {
    //     $("#id").val(id); 
    //     $("#hiddenshoweditmodal").click();
    // }

    // function openempdegreedetailpage(id) {
    //     $("#id").val(id); 
    //     $("#hiddenopendetailpage").click();
    // }




  $(document).ready(function() {


    
      // $("#toperrbar").hide();
      //     $('#save').click(function() {
      //     // $("#toperrbar").show(1000);
      //     $('#toperrbar').slideDown();
      // });


//     var userDate = '1999-02-13 00:00:00';
//             var date_string = moment(userDate, "YYYY.MM.DD").format("MM/DD/YYYY");
//             $("#HireDate").html(date_string);

// $('#framework').multiselect({
//   nonSelectedText: 'Select Framework',
//   enableFiltering: true,
//   enableCaseInsensitiveFiltering: true,

//   includeSelectAllOption: true,
//   buttonClass: 'showhide',
//   nonSelectedText: 'Select Secondary Projects',
//   enableClickableOptGroups: true,
//   // buttonContainer: '<div style="height: 64px;" />',
//   // selectAllText: 'Check all!'
//   // buttonWidth:'400px'
//   // buttonWidth:'323px'
//  });
 

//  $('#multiprosearchsecproject').multiselect({
//   nonSelectedText: 'Select Framework',
//   enableFiltering: true,
//   enableCaseInsensitiveFiltering: true,

//   includeSelectAllOption: true,
//   buttonClass: 'showhide',
//   nonSelectedText: 'Select Secondary Projects',
//   enableClickableOptGroups: true,
//   // buttonContainer: '<div style="height: 64px;" />',
//   // selectAllText: 'Check all!'
//   // buttonWidth:'400px'
//   // buttonWidth:'323px'
//  });

//      var data = [
//     {label: 'Option 1', title: 'Option 1', value: '1', selected: true},
//     {label: 'Option 2', title: 'Option 2', value: '2'},
//     {label: 'Option 3', title: 'Option 3', value: '3'},
//     {label: 'Option 4', title: 'Option 4', value: '4'},
//     {label: 'Option 5', title: 'Option 5', value: '5'},
// ];

// $("#framework").multiselect('dataprovider', data); 

});



  </script>

</body>

</html>