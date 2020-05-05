<template>
  <div>
    <button type="button" v-on:click="showempcolselectormodal" class="btn btn-default pull-right btn-sm"
      style="margin-top:-3px;">
      <span class="glyphicon glyphicon-cog"></span> Settings
    </button>
    <h2 style="margin-top: 10px; margin-bottom: 5px; font-size:25px;">Employee Search</h2>

    <div style="border: 1px solid #3c8dbc;">
      <empcolselector v-bind:colsel="fields" />
      <input type="text" id="hiddenid" name hidden />

      
      <!-- TABLE BODY - Extra div for Styling Table Div -->
      <div class="table-body" style="padding:7px;padding-top: 8px;">

        <!-- SEARCH FORM DIV -->
        <div id="combo" class="container-fluid">
          <form class="form-horizontal" id="srcform">
            <div class="col-xs-4">
              <div class="form-group">
                <label class="control-label col-sm-3">JobTitle</label>
                <div class="col-md-8">
                  <!-- //note have to rename id for JobTitle id to avoid conflict with empeditmodal component -->
                  <select type="select" class="form-control" name="JobTitle" id="srcJobTitle">
                    <option v-for="item in lstJobTitle" :value="item.ListID">{{ item.Str1 }}</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-3">Department</label>
                <div class="col-md-8">
                  <select type="select" class="form-control" name="Department" id="srcDepartment">
                    <option v-for="item in lstDepartment" :value="item.ListID">{{ item.Str1 }}</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-3">Degree</label>
                <div class="col-md-8">
                  <select type="select" class="form-control" name="EmpDegree" id="srcEmpDegree">
                    <option v-for="item in lstEmpDegree" :value="item.ListID">{{ item.str1 }}</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-3">Registration</label>
                <div class="col-md-8">
                  <select type="select" class="form-control" name="Registration" id="srcRegistration">
                    <option v-for="item in lstRegistration" :value="item.ListID">{{ item.Str1 }}</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-3">Training</label>
                <div class="col-md-8">
                  <select type="select" class="form-control" name="EmpTraining" id="srcEmpTraining">
                    <option v-for="item in lstEmpTraining" :value="item.ListID">{{ item.Str1 }}</option>
                  </select>
                </div>
              </div>
            </div>
            <!-- end col 1 -->

            <div class="col-xs-4" style="padding-left: 0px;">
              <div class="form-group">
                <label class="control-label col-sm-4">DisciplineSF254</label>
                <div class="col-md-8">
                  <select type="select" class="form-control" name="DisciplineSF254" id="srcDisciplineSF254">
                    <option v-for="item in lstDisciplineSF254" :value="item.ListID">{{ item.Str1 }}</option>
                  </select>
                </div>
              </div>

              <!-- <div class="form-group">
            <label class="control-label col-sm-4">DisciplineSF330</label>
            <div class="col-md-8">
            <select type="select" class="form-control" name="DisciplineSF330" id="srcDisciplineSF330" >
              <option v-for="item in lstDisciplineSF330" :value="item.ListID">{{ item.Str2  }}</option>
            </select>
          </div>
              </div>-->

              <div class="form-group">
                <label class="control-label col-sm-4">DisciplineSF330</label>
                <div class="col-md-8">
                  <select type="select" class="form-control" name="DisciplineSF330" id="srcDisciplineSF330">
                    <option v-for="item in lstDisciplineSF330" :value="item.ListID">{{ item.Str2 }}</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-4">Owner</label>
                <div class="col-md-8">
                  <select type="select" class="form-control" name="Owner" id="srcOwner">
                    <option v-for="item in lstCAOID" :value="item.CAOID">{{ item.Name }}</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-4">Client</label>
                <div class="col-md-8">
                  <select type="select" class="form-control" name="Client" id="srcClient">
                    <option v-for="item in lstCAOID" :value="item.CAOID">{{ item.Name }}</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-4">ProOCategory</label>
                <div class="col-md-8">
                  <select type="select" class="form-control" name="ProOCategory" id="srcProOCategory">
                    <option v-for="item in lstProOCategory" :value="item.ListID">{{ item.Str1 }}</option>
                  </select>
                </div>
              </div>
            </div>
            <!--  end co2  -->

            <div class="col-xs-4">
              <div class="form-group">
                <label class="control-label col-sm-4">Project Type</label>
                <div class="col-md-8">
                  <select type="select" class="form-control" name="ProjectType" id="srcProjectType">
                    <option v-for="item in lstProjectType" :value="item.ListID">{{ item.Str1 }}</option>
                  </select>
                </div>
              </div>

              <!--<div class="form-group">
            <label class="control-label col-sm-4">Project P Role</label>
            <div class="col-md-8">
              <select type="select" v-model="ProPRole"   class="form-control" name="ProPRole" id="ProPRole" >
                <option v-for="item in lstProPRole" :value="item.ListID">{{ item.Str1  }}</option>
              </select>
            </div>
              </div>-->

              <div class="form-group">
                <label class="control-label col-sm-4">Project Role</label>
                <div class="col-md-8">
                  <select type="select" class="form-control" name="EmpProjectRole" id="srcEmpProjectRole">
                    <option v-for="item in lstEmpProjectRole" :value="item.ListID">{{ item.Str1 }}</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-4">Emp. Status</label>
                <div class="col-md-8">
                  <select type="select" class="form-control" name="EmployeeStatus" id="srcEmployeeStatus">
                    <option v-for="item in lstEmployeeStatus" :value="item.ListID">{{ item.Str1 }}</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-4">Experience</label>
                <div class="col-md-8">
                  <input type="text" class="form-control" />
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-4">Company</label>
                <div class="col-md-8">
                  <select type="select" class="form-control" name="ComID" id="srcComID">
                    <option v-for="item in lstComID" :value="item.ComID">{{ item.CompanyName }}</option>
                  </select>
                </div>
              </div>
            </div>
            <!--  end co3 -->
          </form>

          <div class="filter-bar pull-right">
            <div class="form-inline">
              <div class="form-group" style="margin-right: 15px;">
                <!-- <button @click="search" class="btn btn-primary" style="width: 80px;">Search</button>  -->
                <!-- <button onclick="var table= $('#empSearchTable').DataTable();table.ajax.reload();" class="btn btn-primary" style="width: 80px;">Search</button>  -->
                <!-- <button id="search" class="btn btn-primary" style="width: 80px;">Search</button>  -->

                <!-- <button @click="search"   class="btn btn-primary btn-sm " style="margin-right:3px;margin-top:6px;width: 80px;background-color: #2a88bd">Search</button> 
                <button @click="srcreset" class="btn btn-default btn-sm " style="width: 70px;margin-top:6px;">Reset</button>-->
              </div>
            </div>
          </div>
        </div>
        <!-- END SEARCH FORM DIV -->


        <button @click="srcreset" class="btn btn-default btn-sm pull-right"
          style="width: 70px;margin-right:0px;margin-bottom:6px;">
          <span aria-hidden="true" class="glyphicon glyphicon-refresh"></span> Reset
        </button>
        <button @click="search" class="btn btn-primary btn-sm pull-right"
          style="margin-right:5px;width: 80px;background-color: #2a88bd">Search</button>

        <table id="empSearchTable" class="table table-striped table-bordered"
          style="width:100%;border:1px solid #cecece !important">
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
      </div>
      <!-- For Styling Table Div -->
    </div>
  </div>
</template>


<script>
  import empcolselector from "./EmpColSelector.vue";

  export default {
    components: {
      empcolselector
    },
    data() {
      return {
        emps: [],
        modalheading: "Add Employee",
        addMode: true,
        empid: 0,
        loading: true,
        testVuex: this.$store.state.test,
        jobtitles: [],
        registration: [],

        fields: [
          {
            name: "id", // name property  used in route list to use with parameter
            visible: true
          }
        ],

        // lstPrefix: [],
        // lstSuffix: [],
        lstJobTitle: [],
        lstDepartment: [],
        lstRegistration: [],
        lstDisciplineSF330: [],
        lstDisciplineSF254: [],
        lstEmployeeStatus: [],
        lstComID: [],
        lstEmpDegree: [],

        lstEmpTraining: [],
        lstCAOID: [],
        lstProOCategory: [],
        lstProjectType: [],
        lstEmpProjectRole: []
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
      showempcolselectormodal() {
        $("#empcolselectormodal").modal("show");
      },

      loadJobTitle() {
        this.$axios
          // .get(this.$host + "api/jobtitle")
          .get(this.$host + "api/empjobtitle")
          .then(response => {
            this.jobtitles = response.data;
            // console.log(response.data);
          })
          .catch(err => {
            console.log(err);
          });
      },
      loadRegistration() {
        this.$axios
          // .get(this.$host + "api/registration")
          .get(this.$host + "api/empregistration")
          .then(response => {
            this.registration = response.data;
            // console.log(response.data);
          })
          .catch(err => {
            console.log(err);
          });
      },
      srcreset() {
        $("#firstname").val("");
        $("#lastname").val("");
        $("#jobtitle").val("");
        $("#registration").val("");

        var table = $("#empSearchTable").DataTable();
        table.ajax.reload();
        this.loading = false;
      },
      search() {
        var table = $("#empSearchTable").DataTable();
        table.ajax.reload();
        this.loading = false;
      },


      resetModal() {
        if (localStorage.getItem("empadd") == 0) {
          alert("You do not have permission to Add");
          return;
        }
        this.$refs.editmodalcomponent.resetModal();
      },

      loadTable() {

        $("#empSearchTable")
          .DataTable()
          .ajax.reload();
        this.loading = false;
      },

      remove(empid) {
        this.loading = true;

        this.$axios
          // .delete("http://localhost:8000/api/employee/" + empid)
          .post(this.$host + "api/deleteemployee/" + empid, null, this.$config)
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

      openempdetailpage(empid) {
        this.$router.push({
          name: "empdetail", // name property of this route must be used in route list to use with parameter
          params: { empid: this.empid },
          query: { this: this.empid } // query param is used to pass empid to detail page to use it for refresh(id is lost in detail page when page is refreshed)
        });
      },

      showaddmodal() {
        if (localStorage.getItem("empadd") == 0) {
          alert("You do not have permission to Add");
          return;
        }
        this.resetModal();
        $("#addEmp").modal("show");
      },

      showempeditmodal(empid) {
        // alert(empid);
        if (localStorage.getItem("empedit") == 0) {
          alert("You do not have permission to Add");
          return;
        }
        this.$refs.editmodalcomponent.loadeditdata(empid);
      }
    },

    mounted() {
      var self = this;
      this.loading = true;

      //For Preventing Entry by URL without Login
      if (localStorage.getItem("token") == "") {
        this.$router.push({ name: "login" });
      }
      // else {
      //   this.loadTable();
      // }

      $("#empSearchTable").on("click", "#empview", function () {
        self.empid = $("#hiddenid").val();
        self.openempdetailpage();
      });

      $("#empSearchTable").on("click", "#empedit", function () {
        self.empid = $("#hiddenid").val();
        self.showempeditmodal(self.empid);
      });

      $("#empSearchTable").on("click", "#empdelete", function () {
        self.empid = $("#hiddenid").val();
        self.remove(self.empid);
      });


      // Data Table JQUERY
      // self.loading = true;
      $(document).ready(function () {

        $("#empSearchTable").dataTable({
          serverSide: true,
          searching: false,
          order: [[1, "asc"]], // order by EmployeeID
          lengthMenu: [
            [15, 25, 50, 100, -1],
            [15, 25, 50, 100, "All"]
          ],
          processing: true,
          language: {
            processing: "<img src='/img/loading4.gif' style='margin-left:100px;margin-top:100px;'>"
            //processing: "loading",
          },

          // BUTTONS
          dom: "Blfrtip", //** add "l" after B to show pagelength which hides after button add
          // "dom": '<"top"Bf>rt<"bottom"lip><"clear">',
          buttons: [
            // 'pageLength','copy', 'csv', 'excel', 'print',
            {
              extend: "excelHtml5",
              title: "Excel",
              text:
                '<div style="font-size:14px;padding:0;"><img src="/img/excel.png" alt="" style="height:16px;"><span class="glyphicon excel"></span> Export to excel</div>'
              //     //Columns to export
              //     //exportOptions: {
              //     //     columns: [0, 1, 2, 3,4,5,6]
              //     // }
            }
            // {
            //     extend: 'pdfHtml5',
            //     title: 'PDF',
            //     // text: 'Export to PDF'
            //     text:'<a href="/kseprojects/create_project" style="margin-left: 8px;"><img src="/media/icons/pdf-icon-18-bw.png" alt=""></i></a>'
            //     //Columns to export
            //     //exportOptions: {
            //     //     columns: [0, 1, 2, 3, 4, 5, 6]
            //     //  }
            // }
          ],

          ajax: {
            // url: "http://localhost:8000/api/employeesearch",
            url: self.$host + "api/employee/search", //FOR local Node-Js Backend
            // dataSrc: "",  //FOR NON SERVER Side
            // processing: true, //FOR NON SERVER Side
            dataType: "JSON",
            type: "POST",

            data: function (d) {
              // d.firstname = $("#firstname").val();
              // d.lastname = $("#lastname").val();
              // d.jobtitle = $("#jobtitle").val();
              // d.registration = $("#registration").val();
              // // this.loading = false;
            },
            headers: {
              Authorization: "Bearer " + localStorage.getItem("token"),
              Accept: "application/json" //the token is a variable which holds the token
            }
            // "mDataProp":""
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
                  "<a  onclick=$('#hiddenid').val(" +
                  row.EmpID +
                  ");id='empview' style='cursor:pointer'>" +
                  data +
                  "</a>"
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
              data: "HireDate",
              render: function (data, type, row) {
                if (data == null) {
                  // to replace "Invalid Date" with "", happens when date field is NULL
                  return "";
                }
                // if (data == '1900-01-01 00:00:00') { // to replace "default Date"(put by html5 datepicker) with ""
                //     return "";
                // }
                // else {
                //     return (moment(data).format("MM/DD/YYYY"));
                // }
                if (data == "0000-00-00") {
                  // to replace "default Date"(put by html5 datepicker) with ""
                  return "";
                } else {
                  return self.$moment(data).format("MM/DD/YYYY");
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
              defaultContent: ""
              //   width: "90px",
              // visible: false
            },
            {
              data: "ExpWithOtherFirm",
              //defaultContent: "",// to avoid showing error on null values
              visible: false
            },
            {
              data: "EmpID",
              // width: "100px",
              searchable: false,
              orderable: false,
              visible: false,
              render: function (data, type, row) {
                return (
                  "<a onclick=$('#hiddenid').val(" +
                  row.EmpID +
                  "); id='empview'; style='cursor:pointer'>View</a> | <a onclick=$('#hiddenid').val(" +
                  row.EmpID +
                  "); id='empedit' style='cursor:pointer'>Edit</a> | <a onclick=$('#hiddenid').val(" +
                  row.EmpID +
                  "); id='empdelete' style='cursor:pointer'>Delete</a>"
                );
              }
            }

           ] // end datatable columns *****************************************

        }); //End of Data Table************************************************

        // self.loading = false;



        // ColSelector method, Column visibility Following code can be used to hide action column as per user role
        // *********************************************************************************************
        $("input.vis").on("click", function (e) {
          //e.preventDefault(); checkbox will not chk with this line
          var table = $("#empSearchTable").DataTable();
          // Get the column API object
          var column = table.column($(this).attr("data-column"));
          // Toggle the visibility
          column.visible(!column.visible());
        });


      }); // End of Documnert Ready ********************************************

      this.loading = false;

      // now receiving all combo in one request under a group
      // **********************************************************************
      setTimeout(() => {
        
        this.$axios
          .get(self.$host + "api/empcombo/empsearch")
          .then(response => {
            this.lstJobTitle = response.data[0].jobtitle;
            this.lstDepartment = response.data[1].department;
            this.lstPrefix = response.data[2].prefix;
            this.lstSuffix = response.data[3].suffix;
            this.lstRegistration = response.data[4].registration;
            this.lstDisciplineSF330 = response.data[5].disciplinesf330;
            this.lstDisciplineSF254 = response.data[6].disciplinesf254;
            this.lstEmployeeStatus = response.data[7].employeestatus;
            this.lstComID = response.data[8].comid;
            // child tables
            this.lstEmpDegree = response.data[9].empdegree;
            this.lstEmpTraining = response.data[10].emptraining;
            // project related
            this.lstProjectType = response.data[11].projecttype;
            this.lstCAOID = response.data[12].caoid;
            this.lstProOCategory = response.data[13].proocategory;
            this.lstEmpProjectRole = response.data[14].empprojectrole;
          })
          .catch(err => {
            console.log(err);
            console.log("going");
          });

      }, 200); // This promise will be resolved in 2000 milli-seconds



    } //End Mounted *********************************************

  }; //end export default ***************************************

</script>




<style scoped>
  #combo {
    height: auto;
    padding: 0px;
    padding-top: 15px;
    /* padding-bottom: 15px; */
    margin: 0px;
    margin-bottom: 10px;
    border: 1px solid lightgrey;
    background-color: #f0f0f0;
  }

  /* search combo styles************************************ */
  #combo .form-group {
    margin-bottom: 5px;
  }

  #combo select[type="select"] {
    height: 27px;
    border-radius: 0px;
  }

  #combo input[type="text"] {
    height: 30px;
    border-radius: 0px;
  }

  /*align labels left*/
  .form-horizontal .control-label {
    text-align: left;
    margin-bottom: 0px;
    font-size: 12px;
    color: black;
    padding-top: 4px;
    font-weight: normal;
  }

  /* END search combo styles************************************ */

  .testdiv {
    margin: 0;
    padding: 0;
    padding-left: 0px;
    height: 80vh;
    width: 75%;
    position: fixed;
    /* background-color: black;
  opacity: 0.3; */
    /* background-image: url(../../../public/img/loading.gif); */
    background-image: url(/img/loading.gif);
    background-position: center;
    background-repeat: no-repeat;
    z-index: 100;
  }

  .form-group label {
    margin-bottom: 0px;
  }
</style>