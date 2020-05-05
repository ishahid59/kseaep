<template>
  <div style="border: 1px solid #3c8dbc;">
     
    <div
      style="margin-top:0px; background-color:rgb(241, 241, 241); padding:7px;  padding-bottom:2px;    border-bottom: 1px solid #d3e0e9">
      <button type="button" v-on:click="showempcolselectormodal" class="btn btn-default pull-right btn-sm" style="margin-top:1px;"><span class="glyphicon glyphicon-cog"></span> Settings </button>
      <h1 style="font-size: 28px; margin-top:0px;margin-bottom:6px">Employee Table</h1>
    </div>

    <input type="text" id="hiddenid" name hidden />
    <empcolselector v-bind:colsel="fields" />
    <!-- <empeditmodal ref="editmodalcomponent" v-bind:empid="empid" /> -->
    <!-- <globalunauthorisedmsg /> -->


    <!-- Extra div for Styling Table Div -->
    <div class="table-body" style="padding:7px; z-index:100;">

      <a type="button" class="btn btn-default pull-right btn-sm "
        style="margin-left:4px;margin-bottom:10px;color:#006fae;" v-on:click="showempaddmodal"> <span aria-hidden="true"
          class="glyphicon glyphicon-plus" style="color:#006fae"></span> Add new</a>
      <a style="margin-left:4px;" type="button" id="reset" class="btn btn-default pull-right btn-sm"><span
          aria-hidden="true" class="glyphicon glyphicon-refresh"></span> Reset</a>


      
      <table id="employeeTable" class="table table-striped table-bordered" style="width:100%;border:1px solid #cecece !important;background-color:white">
       
        <thead>
          <tr>
            <th>Id</th>
            <th>EmployeeID</th>
            <th>First name</th>
            <th>Last name</th>
            <th>Company</th>
            <th>Job title</th>
            <th>Department</th>
            <th>Registration</th>
            <th>Hire date</th>
            <th>Discipline SF254</th>
            <th>Discipline SF330</th>
            <th>Status</th>
            <th>Exp. with other firm</th>
            <!-- <th>Consultant</th>  -->
            <th style="width:130px;">Action</th>
          </tr>
        </thead>

      </table>


    </div><!-- For Styling Table Div -->
    </div>

</template>


<script>

  // import moment from 'moment';
  import empcolselector from "./EmpColSelector.vue";
  // import empeditmodal from "./EmpEditModal.vue";

  export default {

    components: {
      empcolselector,
      // empeditmodal
    },

    data() {
      return {
        emps: [],
        modalheading: "Add Employee",
        addMode: true,
        empid: 0,
        loading: true,
        testVuex: this.$store.state.test,

        fields: [
          {
            name: "id",
            visible: true
          }
        ],

      };
    },
    computed: {
      anyRemaining() {
        // this.$store.state.test = "CHANGED";
        // return this.$store.getters.getTest;
        return this.$store.state.test;
      }
    },
    methods: {
      test() {
        this.$store.dispatch("addTodo", "PARAM");
      },
      // resetModal() {
      //   if (localStorage.getItem("empadd") == 0) {
      //     alert("You do not have permission to Add");
      //     return;
      //   }
      //   this.$refs.editmodalcomponent.resetModal();
      // },

      showempcolselectormodal() {
        $("#empcolselectormodal").modal("show");
      },

      loadTable() {
        this.loading = true;

        // // let data = {
        // //     'HTTP_CONTENT_LANGUAGE': this.language
        // //   }

        // // // axios.post(URL, data, config).then(...)
        // // let config = {
        // //   headers: {
        // //     Accept: "application/json",
        // //     Authorization: "Bearer "+ localStorage.getItem("token"),
        // //   }
        // // }
        // // alert(localStorage.getItem("token"));
        // // alert(this.$config);
        // // this.$axios.get("http://localhost:8000/api/employee",config).then(response => {
        // //  this.$axios.get("http://localhost:8000/api/employee").then(response => {

        // // this.$axios
        // //   .get(this.$host + "api/employee",data, config).then(response => {
        // // this.$axios
        // // .get(this.$host + "api/employee",data, config).then(response => {

        // //   this.emps = response.data;
        // //   console.log(this.emps);
        // // })

        // // .catch(err => {
        // //   console.log(err);
        // // });

        // this.$axios
        //   .get(
        //     this.$host + "api/employee",
        //     this.$config
        //     // {
        //     //   headers: {
        //     //     Authorization: "Bearer " + localStorage.getItem("token"),
        //     //     Accept:"application/json" //the token is a variable which holds the token
        //     //  } }
        //   )
        //   .then(response => {
        //     this.emps = response.data;
        //     $("#employeeTable")
        //       .DataTable()
        //       .ajax.reload();
        //     this.loading = false;
        //   })
        //   .catch(err => {
        //     //Cannot get err.status in axios for network error
        //     if (err.message === "Network Error") {
        //       iziToast.error({
        //         title: "Network Error",
        //         message: "Please check your Connection to Server"
        //       });
        //     }else{
        //       iziToast.error({
        //         title: "Error",
        //         message: err.response.message
        //       });
        //     }
        //   });

        $("#employeeTable")
          .DataTable()
          .ajax.reload();
        this.loading = false;
      },

      remove(empid) {
        this.loading = true;

        this.$axios
          // .delete("http://localhost:8000/api/employee/" + empid)
          // .post(this.$host + "api/deleteemployee/" + empid, null, this.$config)
          .delete(this.$host + "api/employee/" + empid, null, this.$config)
          .then(response => {
            this.loadTable();
            this.loading = false;
            iziToast.success({
              title: "Deleted",
              message: "Employee Has Been Deleted"
            });
          })
          .catch(err => {
            console.log(err);
          });
      },
      // showaddmodal() {
      //   if (localStorage.getItem("empadd") == 0) {
      //     alert("You do not have permission to Add");
      //     return;
      //   }
      //   this.resetModal();
      //   $("#addEmp").modal("show");
      // },
    showempaddmodal() {

      // // https://www.youtube.com/watch?v=sW6MStdkFJE using front end permission using laravel acl
      // // if (!this.$gate.isAdmin) { // cannot use this since it needs laravel latest ver
      // var s1=this.$usertype;
      // var s2="admin";
      // if (s1.trim() !== s2.trim()) { // trim should be used for js string compare for any white space
      //   // alert("You don't have permission to run this operation");
      //   $("#globalunauthorisedmsg").modal("show");
      //   return;
      // } 

      $('#empform').trigger("reset");
      // $('#empform')[0].reset();
      this.$refs.editmodalcomponent.clearaddform();
      $("#empeditmodal").modal("show");

    },







      showempeditmodal(empid) {
        // alert(empid);
        // if (localStorage.getItem("empedit") == 0) {
        //   alert("You do not have permission to Add");
        //   return;
        // }
        
        this.$refs.editmodalcomponent.loadeditdata(empid);
        $("#empeditmodal").modal("show");
      },



      openempdetailpage(empid) {
        this.$router.push({
          name: "empdetail", // name property of this route must be used in route list to use with parameter
          params: { empid: this.empid },
          query: { this: this.empid } // query param is used to pass empid to detail page to use it for refresh(id is lost in detail page when page is refreshed)
        });
      }




    },




    mounted() {


      var self = this;
      this.loading = true;

      // // For Preventing Entry by URL without Login
      // // Closed for testing on Heroku
      // if (localStorage.getItem("token") == "") {
      // if (localStorage.getItem("token") == null) {
      //   this.$router.push({ name: "login" });
      // }
      // else {
      //   this.loadTable();
      // }


      $("#employeeTable").on("click", "#empview", function () {
        self.empid = $("#hiddenid").val();
        self.openempdetailpage();
      });

      $("#employeeTable").on("click", "#empedit", function () {
        self.empid = $("#hiddenid").val();
        self.showempeditmodal(self.empid);
      });

      $("#employeeTable").on("click", "#empdelete", function () {
        self.empid = $("#hiddenid").val();
        self.remove(self.empid);
      });



      //Data Table JQUERY

      $(document).ready(function () {

        $("#employeeTable").dataTable({
          serverSide: true,
          "order": [[1, "asc"]], // order by EmployeeID
          "lengthMenu": [[15, 25, 50, 100], [15, 25, 50, 100]],
          //"lengthMenu": [[10, 15, 25, 50, 100, -1], [10, 15, 25, 50, 100, "All"]],
          processing: true,
          language: {
            processing: "<img src='/img/loading4.gif'>", //global root(public folder) path
            // processing: "<img src='../../img/loading4.gif'>", //relative folder path
            //processing: "loading",
          },


          // BUTTONS
          dom: 'Blfrtip',//** add "l" after B to show pagelength which hides after button add
          // "dom": '<"top"Bf>rt<"bottom"lip><"clear">',
          buttons: [
            // // 'pageLength','copy', 'csv', 'excel', 'print',
            // // 'copy', 'csv', 'excel',

            // {
            //     // create a custom button
            //     title: 'mybutton',
            //     attr: { id: 'mybutton' }, // asign id to custom button
            //     text: '<div style="font-size:14px;padding:0;"><span aria-hidden="true" class="glyphicon glyphicon-plus" style="color:#337ab7"></span> Add new</div>',
            // }, 
            {
              extend: 'excelHtml5',
              title: 'Excel',
              text: '<div style="font-size:14px;padding:0;"><img src="/img/excel.png" alt="" style="height:16px;"><span class="glyphicon excel"></span> Export to excel</div>',
              // text: '<a style="font-size:24px;" ><i class="fa fa-file-excel-o style="font-size:24px;" aria-hidden="true"></i></a>',
              // text:'<a href="/kseprojects/create_project" style="margin-left: 15px"><img src="./media/icons/excel-icon-18-bw.png" alt=""></i></a>'
              //  text:'<img src="excel-16.png" alt="2">'

              //Columns to export
              //exportOptions: {
              //     columns: [0, 1, 2, 3,4,5,6]
              // }
            },
            // {
            //     extend: 'pdfHtml5',
            //     title: 'PDF',
            //     text: 'Export to PDF'
            //     // text:'<a href="/kseprojects/create_project" style="margin-left: 8px;"><img src="./media/icons/pdf-icon-18-bw.png" alt=""></i></a>'
            //     //Columns to export
            //     //exportOptions: {
            //     //     columns: [0, 1, 2, 3, 4, 5, 6]
            //     //  }
            // }
          ],






          ajax: {

            // url: "http://localhost:8000/api/employee", //FOR LARA-Backend
            // url:"https://ksep2.herokuapp.com/api/employee",//For Heroku Node
            // url: "http://fshahidksep.000webhostapp.com/api/employee", //FOR 000webhostapp-Backend
            // url: "http://localhost:5000/api/employee", //FOR Node-Js Backend
            url: self.$host + "api/employee", //FOR local Node-Js Backend
            // url: "http://ksep2.herokuapp.com/api/employee", //FOR Node-Js web Heroku Backend

            // dataSrc: "",  //FOR NON SERVER Side
            // processing: true, //FOR NON SERVER Side
            // "mDataProp":""

            // **MAKE the dqatatable api POST since get request sql gets boig and cannot handle more than 9 cols
            // type: "GET",
            type: "POST",

            headers: {
              Authorization: "Bearer " + localStorage.getItem("token"),
              Accept: "application/json" //the token is a variable which holds the token
            },

          },
          // lengthMenu: [5, 10, 20, 50, 100, 200, 500],
          columns: [
            {
              data: "EmpID",
              visible: false
            },
            {
              data: "EmployeeID",
              width: "80px", //to prevent thead jumping on load
              render: function (data, type, row) {
                return (
                  "<a  onclick=$('#hiddenid').val(" + row.EmpID + ");id='empview' style='cursor:pointer'>" + data + "</a>"
                );
              }
            },
            {
              data: "Firstname"
              //   width: "80px",
            },
            {
              data: "Lastname",
              //   width: "80px",
              visible: false
            },
            {
              data: "ComID",
              defaultContent: "",
              visible: false
            },
            {
              data: "JobTitle"
              //   width: "150px",
              // "defaultContent": "" // to avoid showing error on null values
            },
            {
              data: "Department"
              // "defaultContent": "",
              // visible: false
            },
            {
              data: "Registration",
              defaultContent: ""
              //visible: false
            },
            {
              "data": "HireDate", "render": function (data, type, row) {
                if (data == null) { // to replace "Invalid Date" with "", happens when date field is NULL
                  return "";
                }
                // if (data == '1900-01-01 00:00:00') { // to replace "default Date"(put by html5 datepicker) with ""
                //     return "";
                // }
                // else {
                //     return (moment(data).format("MM/DD/YYYY"));
                // }
                if (data == '0000-00-00') { // to replace "default Date"(put by html5 datepicker) with ""
                  return "";
                }
                else {
                  return (self.$moment(data).format("MM/DD/YYYY"));
                }
              }
            },
            {
              data: "DisciplineSF254",
              defaultContent: "",
              visible: false
            },
            {
              data: "DisciplineSF330",
              defaultContent: "",
              visible: false
            },
            {
              data: "EmployeeStatus",
              defaultContent: "",
              //   width: "90px",
              // visible: false
            },
            {
              data: "ExpWithOtherFirm",
              //defaultContent: "",// to avoid showing error on null values
              visible: false
            },
            //  {
            //     "data": "employee_consultant",
            //     "defaultContent": "",
            //     // "visible": false,
            // },

            // {
            //   mData: "empid",
            //   render: function(data, type, row) {
            //     return (
            //       "<a style='cursor:pointer' onclick=$('#hiddenid').val(" +
            //       row.empid +
            //       ") ; id='empedit'>Edit</a> |   <a style='cursor:pointer' onclick=$('#hiddenid').val(" +
            //       row.empid +
            //       ") id='empdelete'>Delete</a>"
            //     );
            //   }
            // },

            {
              data: "EmpID",
              // width: "100px",
              searchable: false,
              orderable: false,
              visible: false,
              render: function (data, type, row) {
                return (
                  "<a onclick=$('#hiddenid').val(" + row.EmpID + "); id='empview'; style='cursor:pointer'>View</a> | <a onclick=$('#hiddenid').val(" + row.EmpID + "); id='empedit' style='cursor:pointer'>Edit</a> | <a onclick=$('#hiddenid').val(" + row.EmpID + "); id='empdelete' style='cursor:pointer'>Delete</a>"
                );
              }
            }

          ]// end datatable columns

        });// End of Data Table


        // ColSelector method
        // $(document).ready(function() {
        // Column visibility
        $("input.vis").on("click", function(e) {
          //e.preventDefault(); checkbox will not chk with this line
          var table = $("#employeeTable").DataTable();
          // Get the column API object
          var column = table.column($(this).attr("data-column"));
          // Toggle the visibility
          column.visible(!column.visible());
        });

          $('#reset').on('click', function () {
              // $('#empSearchForm')[0].reset();
              var table = $('#employeeTable').DataTable();
              table.search('').columns().search('').draw();//clear datatable search filter
              table.ajax.reload();
              (this).blur();// to move focus from btn
          });

          $('#mybutton').on('click', function () {
              // $('#empSearchForm')[0].reset();
              alert("test");
          });

          // Following code can be used to hide action column as per user role
          // var table = $("#employeeTable").DataTable();
          // var column = table.column(1);
          // column.visible(!column.visible());

          var oTable = $('#employeeTable').DataTable();   //pay attention to capital D, which is mandatory to retrieve "api" datatables' object, as @Lionel said
          $('#myInputTextField').keyup(function(){
                oTable.search($(this).val()).draw() ;
          })
                console.log(this.$apitoken);
        // });









      });// End of Documnert Ready

    } // end mounted

  }; // end export default


</script>





<style scoped>
  /* not working in common css so put in one of the component */
  /* class for processing img, to remove the box around the image */
  /* .dataTables_processing{
  position: absolute;
  border: none;
  background: transparent;
} */




  .testdiv {
    margin: 0;
    padding: 0;
    padding-left: 0px;
    height: 80vh;
    width: 75%;
    position: fixed;
    /* background-color: black;
  opacity: 0.3; */
    background-image: url(../../public/img/loading.gif);
    background-position: center;
    background-repeat: no-repeat;
    z-index: 0;
  }

  .form-group label {
    margin-bottom: 0px;
  }



  /* Datatable Export button styling in index. Not working here */
</style>